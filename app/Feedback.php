<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
      'content',
    ];

    public function category()
    {
      return $this->belongsTo('App\FeedbackCategory', 'category_id');
    }

    public function author()
    {
      return $this->belongsTo('App\User', 'user_id');
    }

    public function feedbackable()
    {
      return $this->morphTo();
    }

    public function dateFormat()
    {
      return date('jS \o\f M\, Y \a\t H:i:s', strtotime($this->created_at));
    }
}
