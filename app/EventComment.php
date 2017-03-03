<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventComment extends Model
{
    protected $table = 'eventcomments';

    protected $fillable = [
      'text', 'user_id', 'event_id',
    ];

    public function author()
    {
      return $this->belongsTo('App\User', 'user_id');
    }

    public function event()
    {
      return $this->belongsTo('App\Event', 'event_id');
    }

    public function addComment($user, $event)
    {
      $this->author()->associate($user);
      $this->event()->associate($event);
      return $this->save();
    }
}
