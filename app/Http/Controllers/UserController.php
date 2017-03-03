<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\Event;
use App\Feedback;
use App\FeedbackCategory;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function home()
    {
      $user = app('auth')->user();
      $myEvents = $user->myEvents;
      $othersEvents = $user->eventParticipations;
      return view('user/home', compact('user', 'myEvents', 'othersEvents'));
    }


    public function feedback()
    {
      return view('user/feedback');
    }

    public function postFeedback(Request $request, $category_name)
    {
      $this->validate($request, [
        'content' => 'required',
      ]);

      $category_id = FeedbackCategory::where('name', '=', $category_name)->first()->id;

      $feedback = new Feedback;
      $feedback->user_id = app('auth')->user()->id;
      $feedback->content = $request->content;
      $feedback->category_id = $category_id;

      switch ($category_name) {
        case 'Suggestion':
          $feedback->feedbackable_id = 0;
          $feedback->feedbackable_type = 'Suggestion';
          $feedback->save();
          break;
        case 'Event':
          if ($this->checkURL(2, $request->url)) {
            $event_id = $this->findID($request->url);
            $event = Event::find($event_id);
            $event->feedbacks()->save($feedback);
          } else {
            //send to error bag 'Please insert a valid event URL'
          }
          break;
        case 'User':
          if ($this->checkURL(3, $request->url)) {
            $user_id = $this->findID($request->url);
            $user = User::find($user_id);
            $user->feedbacks()->save($feedback);
          } else {
            //send to error bag 'Please insert a valid event URL'
          }
          break;
        default:
          return view('errors/503');
      }

      return back();
    }

    public function checkURL($id, $url)
    {
      $type = $id===2 ? 'event' : 'user';
      $pattern = '#.*\/?'.$type.'\/[1-9][0-9]*\/?$#';
      return preg_match($pattern, $url);
    }

    public function findID($url)
    {
      $pos = strrpos($url, "/");
      if ($pos == (strlen($url)-1))
        $pos = strrpos($url, "/", -2);
      $id = substr($url, $pos+1);
      return $id;
    }

    public function viewUser($id){
      $user=User::find($id);
      if($user==null) return view('errors/404');
      $badges = $user->badges()->get();
      $participations = $user->eventParticipations()->get();
      return view('user/user', compact('user', 'badges', 'participations'));
    }

    public function addUserImage(){
      $user = app('auth')->user();
      if($_FILES['picture']['name']!=null){
        $ext = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
        $imgPath = 'img/users/'.$user->id.'.'.$ext;
        Image::make($_FILES['picture']['tmp_name'])->save($imgPath);

        $user->addImage($imgPath);
        $user->save();
      }
      return back();
    }

    public function toggleBan($id)
    {
      $user=User::find($id);
      if($user==null) return view('errors/404');
      $user->toggleBan();
      return back();
    }

}
