<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TierListUpvote extends Model
{
  protected $fillable = ['tier_list_id', 'user_id'];
}
