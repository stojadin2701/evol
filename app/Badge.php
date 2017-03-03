<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    //icon represents the icon URI
    protected $fillable = [
      'name', 'icon',
    ];

    public $timestamps = false;

    public function users()
    {
      return $this->belongsToMany('App\User', 'has_badges', 'badge_id', 'user_id');
    }
}
