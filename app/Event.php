<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
      'dateTimeFrom', 'dateTimeTo', 'location', 'name', 'summary', 'description', 'participantsNeeded',
    ];

    protected $morphClass = 'MorphEvent';

    //protected $dates = ['dateTimeFrom', 'dateTimeTo'];

    public function addCategory($category_id)
    {
      return $this->categories()->attach($category_id);
    }

    public function removeCategory($category_id)
    {
      return $this->categories()->detach($category_id);
    }

    //ako im prosledjujemo pridruzene uri-je pokupljene iz forme
    public function addImages($uris)
    {
      $images = $this->images();
      foreach ($uris as $uri) {
        $images->save(new EventImage(['uri' => $uri]));
      }
    }

    public function addSignUp($user_id)
    {
      $this->participantsApplied++;
      return $this->signedUpUsers()->attach($user_id, ['tracked' => FALSE]);
    }

    public function addParticipant($user, $rating, $note)
    {
      $user->updateRating($rating);
      return $this->participants()->attach($user->id, ['user_rating' => $rating, 'note' => $note]);
    }

    public function removeSignUp($user_id)
    {
      $this->participantsApplied--;
      return $this->signedUpUsers()->detach($user_id);
    }

    public function addComment($user_id, $text)
    {
      $comment = new EventComment;
      $comment->text = $text;
      $user = User::find($user_id);
      return $comment->addComment($user, $this);
    }

    public function comments()
    {
      return $this->hasMany('App\EventComment', 'event_id');
    }

    public function organizer()
    {
      return $this->belongsTo('App\User', 'user_id');
    }

    public function categories()
    {
      return $this->belongsToMany('App\EventCategory', 'belongs_to_categories', 'event_id', 'category_id');
    }

    public function images()
    {
      return $this->hasMany('App\EventImage', 'event_id');
    }

    public function signedUpUsers()
    {
      return $this->belongsToMany('App\User', 'signed_ups', 'event_id', 'user_id')->withPivot('tracked');
    }

    public function participants()
    {
      return $this->belongsToMany('App\User', 'participations', 'event_id', 'user_id')->withPivot('user_rating', 'note');
    }

    public function setDidNotAttend($user)
    {
      $this->signedUpUsers()->detach($user->id);
      return $this->signedUpUsers()->attach([$user->id => ['tracked' => TRUE]]);
    }

    public function setDidAttend($user, $rating, $note)
    {
      $this->addParticipant($user, $rating, $note);
      $this->signedUpUsers()->detach($user->id);
      return $this->signedUpUsers()->attach([$user->id => ['tracked' => TRUE]]);
    }

    public function feedbacks()
    {
      return $this->morphMany('App\Feedback', 'feedbackable');
    }

    public function path()
    {
      return '/event/'.$this->id;
    }

    public function dateFormatFrom()
    {
      return date('jS \o\f M\, Y \a\t H:i:s', strtotime($this->dateTimeFrom));
    }

    public function dateFormatTo()
    {
      return date('jS \o\f M\, Y \a\t H:i:s', strtotime($this->dateTimeTo));
    }

    public function imgPATH()
    {
      return $this->images()->first() ? $this->images()->first()->uri : '/img/events/default_event.png';
    }

    public function isOpenForSignUp()
    {
      date_default_timezone_set('Europe/Belgrade');
      return strtotime("now") < strtotime($this->dateTimeFrom);
    }

    public function isFinished()
    {
      date_default_timezone_set('Europe/Belgrade');
      return strtotime("now") > strtotime($this->dateTimeTo);
    }

    public function hasSignUp($user)
    {
      return $this->signedUpUsers()->get()->contains($user->id, $user->name, $user->username);
    }

}
