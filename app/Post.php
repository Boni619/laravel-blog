<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $guarded = [];

  public function user()
  {
    return $this->hasOne('App\User', 'id', 'user_id');
  }

  public function comments()
  {
    return $this->hasMany('App\Comment', 'post_id', 'id')->orderBy('id', 'desc');
  }
}
