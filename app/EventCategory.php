<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    protected $table = 'eventcategories';

    public $timestamps = false;

    public function events()
    {
      return $this->belongsToMany('App\Event', 'belongs_to_categories', 'category_id', 'event_id');
    }
}
