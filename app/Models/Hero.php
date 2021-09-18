<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
  public function talents()
  {
    return $this->hasMany('App\Models\Talent');
  }

  public function builds()
  {
    return $this->hasMany('App\Models\Build');
  }
}
