<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Build extends Model
{
  protected $fillable = ['name', 'user_id'];

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function talents()
  {
    return $this->belongsToMany('App\Models\Talent');
  }

  public function upvotes()
  {
    return $this->hasMany('App\Models\BuildUpvote');
  }
}
