<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'city', 'bio',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $morphClass = 'MorphUser';

    public function store()
    {
      $user = new User;

    }

    public function comments()
    {
      return $this->hasMany('App\EventComment', 'user_id');
    }

    public function myEvents()
    {
      return $this->hasMany('App\Event', 'user_id');
    }

    //returns the events this user participated in
    //for access to the 'user_rating' and 'note' fields of the table participations use:
    /*
      foreach ($user->eventParticipations as $event) {
        echo $event->pivot->user_rating;
      }
    */

    public function eventParticipations()
    {
      return $this->belongsToMany('App\Event', 'participations', 'user_id', 'event_id')->withPivot('user_rating', 'note');
    }

    public function signedUpForEvents()
    {
      return $this->belongsToMany('App\Event', 'signed_ups', 'user_id', 'event_id');
    }

    public function badges()
    {
      return $this->belongsToMany('App\Badge', 'has_badges', 'user_id', 'badge_id');
    }

    public function isAdmin()
    {
      return $this->privilege == 1;
    }

    public function setAdminPrivileges()
    {
      return $this->privilege = 1;
    }

    public function isMod()
    {
      return $this->privilege == 2;
    }

    public function setModPrivileges()
    {
      $this->privilege = 2;
    }

    public function removeModPrivileges()
    {
        $this->privilege = 0;
    }

    public function isBanned()
    {
      return $this->banned;
    }

    public function toggleBan()
    {
      $this->banned=!$this->banned;
      $this->save();
    }

    public function rating()
    {
      return $this->ratingSum / $this->ratingNum;
    }

    public function addBadge($badge_name)
    {
      $badge = Badge::where('name', '=', $badge_name)->first();
      return $this->badges()->attach($badge);
    }

    public function figureOutWhatBadgeToAdd()
    {
      return null;
    }

    public function addImage($uri)
    {
      return $this->imgURI = $uri;
    }

    public function getImageURI(){
      return $this->imgURI ? "/".$this->imgURI : "/img/users/default_user.png";
    }

    public function feedbacks()
    {
      return $this->morphMany('App\Feedback', 'feedbackable');
    }

    public function path()
    {
      return '/user/'.$this->id;
    }

    public function updateRating($rating)
    {
      $this->ratingSum += $rating;
      $this->ratingNum++;
      return $this->update();
    }

    public function isNthEvent($n)
    {
      return $this->myEvents()->count() === $n;
    }

}
