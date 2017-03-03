<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedbackCategory extends Model
{
    protected $table = 'feedbackcategories';

    protected $fillable = [
      'name',
    ];

    public $timestamps = false;
}
