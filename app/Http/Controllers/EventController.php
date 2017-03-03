<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\EventCategory;
use App\Event;
use App\EventComment;
use App\User;

use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{
    public function createEvent()
    {
        $content = ['all_categories' => EventCategory::all()];
        return view('event/create', compact('content'));
    }

    private function validation(Request $request)
    {
      $this->validate($request, [
        'title' => 'required',
        'dateFrom' => 'required',
        'dateTo' => 'required',
        'dateFrom' => 'checkDateOrder:dateFrom,dateTo',
        'location' => 'required',
        'summary' => 'required|max:80',
        'description' => 'required',
        'participantsNeeded' => 'required|numeric'
      ]);
    }

    private function fillRequiredInfo(Event $event, Request $request)
    {
      $event->name = $request->title;
      $event->dateTimeFrom = $request->dateFrom;
      $event->dateTimeTo = $request->dateTo;
      $event->location = $request->location;
      $event->summary = $request->summary;
      $event->description = $request->description;
      $event->participantsNeeded = $request->participantsNeeded;
    }

    public function postCreateEvent(Request $request)
    {
        $this->validation($request);

        $event = new Event;
        $user = app('auth')->user();

        $this->fillRequiredInfo($event, $request);
        $event->user_id = $user->id;
        $event->status = "CRE";

        $event->save();

        if ($user->isNthEvent(1))
          $user->addBadge('first');
          if ($user->isNthEvent(10))
            $user->addBadge('tenth');

        $images = [];
        $imageCount = $event->images()->count();

        //if (isset($_FILES['picture']))
        {
          for($i = 0; $i < count($_FILES['picture']['name']); $i++)
          {
            if ($_FILES['picture']['name'][$i] == "") break;

            $ext = pathinfo($_FILES['picture']['name'][$i], PATHINFO_EXTENSION);
            $imgPath = 'img/events/' . $event->id . '_' . ($imageCount + $i) .'.' . $ext;
            Image::make($_FILES['picture']['tmp_name'][$i])->save($imgPath);
            $images[] = $imgPath;
          }
          $event->addImages($images);
        }

        if ($request->categories)
        {
          foreach($request->categories as $category)
          {
            $event->addCategory(EventCategory::where('name', $category)->first());
          }
        }

        return redirect(url('/home'));
    }

    public function editEvent(Event $event)
    {
      if (app('auth')->user()->id != $event->user_id || !$event->isOpenForSignUp())
      {
        return view('errors/503');
      }

      $content = ['all_categories' => EventCategory::all()];

      $content['title'] = $event->name;

      $content['images'] = $event->images()->get();

      $dateFrom = explode(' ', $event->dateTimeFrom);
      $content['dateFrom'] = $dateFrom[0] . 'T' . $dateFrom[1];

      $dateTo = explode(' ', $event->dateTimeTo);
      $content['dateTo'] = $dateTo[0] . 'T' . $dateTo[1];

      $content['location'] = $event->location;
      $content['summary'] = $event->summary;
      $content['description'] = $event->description;
      $content['participantsNeeded'] = $event->participantsNeeded;
      $content['categories'] = $event->categories()->get();
      $content['categories_names'] = [];
      foreach($content['categories'] as $category)
      {
        array_push($content['categories_names'], $category->name);
      }

      $content['event_id'] = $event->id;

      return view('event/edit', compact('content'));
    }

    public function patchEditEvent(Event $event, Request $request)
    {
      $this->validation($request);

      $this->fillRequiredInfo($event, $request);

      $imagesToBeDeleted = explode(';', $request->markedImages);
      foreach($imagesToBeDeleted as $image)
      {
        $eventImage = $event->images()->where('uri', $image)->first();
        if ($eventImage)
        {
          unlink($eventImage->uri);
          $eventImage->delete();
        }
      }

      $images = [];
      $imageCount = $event->images()->count();

      if (isset($_FILES['picture']))
      {
        for($i = 0; $i < count($_FILES['picture']['name']); $i++)
        {
          if ($_FILES['picture']['name'][$i] == "") break;

          $ext = pathinfo($_FILES['picture']['name'][$i], PATHINFO_EXTENSION);
          $imgPath = 'img/events/' . $event->id . '_' . ($imageCount + $i) .'.' . $ext;
          Image::make($_FILES['picture']['tmp_name'][$i])->save($imgPath);
          $images[] = $imgPath;
        }
        $event->addImages($images);
      }

      foreach($event->categories as $category)
      {
        $event->removeCategory($category);
      }
      if ($request->categories)
      {
        foreach($request->categories as $category)
        {
          $event->addCategory(EventCategory::where('name', $category)->first());
        }
      }

      $event->update();

      return back();
    }

    private function getProgressBarFill(Event $event)
    {
      $percentNeeded = 30;
      if ($event->participantsApplied <= $event->participantsNeeded)
      {
        $progressBarFill = floatval($event->participantsApplied) / $event->participantsNeeded * $percentNeeded;
      }
      else
      {
        $progressBarFill = $percentNeeded +
        (-1. / (0.10 * ($event->participantsApplied - $event->participantsNeeded)) + 1.) * (100 - $percentNeeded);
      }
      return $progressBarFill;
    }

    public function viewEvent($id)
    {
      $event = Event::with('organizer', 'categories', 'comments')->find($id);
      if ($event == null) return view('errors/404');
      $progressBarFill = $this->getProgressBarFill($event);
      $percentNeeded = 30;
      $signedUpUsersIds = [];
      foreach($event->signedUpUsers()->get() as $user)
      {
        array_push($signedUpUsersIds, $user->id);
      }
      $comments = $event->comments()->simplePaginate(5);
      return view('event/event', compact('event', 'comments', 'percentNeeded', 'progressBarFill', 'signedUpUsersIds'));
    }

    public function signup(Event $event)
    {
      if (app('auth')->check() and app('auth')->user()->id!=$event->user_id and $event->isOpenForSignUp() and !$event->hasSignUp(app('auth')->user()))
      {
        $user = app('auth')->user();
        $event->addSignUp($user);
        $event->update();
        return $this->getProgressBarFill($event);
      }
      return view('errors/503');
    }

    public function optout(Event $event)
    {
      if (app('auth')->check() and $event->isOpenForSignUp() and $event->hasSignUp(app('auth')->user()))
      {
        $user = app('auth')->user();
        $event->removeSignUp($user);
        $event->update();
        return $this->getProgressBarFill($event);
      }
      return view('errors/503');
    }

    public function trackParticipants(Event $event)
    {
      if($event == null) return view('errors/503');
      $user = app('auth')->user();
      if($event->organizer->id != $user->id) return view('errors/503');
      $untrackedParticipants = $event->signedUpUsers()->where('tracked', '=', false)->get();
      return view('event/track', compact('event', 'untrackedParticipants'));
    }

    public function postTrackParticipants(Request $request, Event $event, User $user)
    {
      if ($request->track=='check') {
        $this->validate($request, [
          'note' => 'required',
          'star' => 'required',
        ]);

        $rating = $request['star'];
        $event->setDidAttend($user, $rating, $request->note);
      }
      elseif ($request->track=='uncheck') {
        $event->setDidNotAttend($user);
      }

      return back();
    }

    public function addComment(Event $event, Request $request)
    {
      $this->validate($request, [
        'comment' => 'required',
      ]);

      if ($event == null) return view('errors/404');

      $event->addComment(app('auth')->user()->id, $request->comment);

      return back();
    }

    public function deleteEvent($id)
    {
        $event = Event::where('id', $id)->first();
        if (app('auth')->user()->id != $event->user_id || !$event->isOpenForSignUp())
        {
            return view('errors/503');
        }
        $event->delete();
        return back();
    }
}
