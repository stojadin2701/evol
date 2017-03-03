<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{
    protected $table = 'eventimages';
    protected $fillable = [ 'uri' ];

    public $timestamps = false;

    public function event()
    {
      return $this->belongsTo('App\Event', 'event_id');
    }
}
