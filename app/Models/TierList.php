<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TierList extends Model
{
  protected $fillable = ['name', 'user_id'];
  
  public function tiers() 
  {
    return $this->hasMany('App\Models\Tier');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function upvotes()
  {
    return $this->hasMany('App\Models\TierListUpvote');
  }
}
