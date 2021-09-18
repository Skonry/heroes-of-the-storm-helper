<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talent extends Model
{
  public $table = 'talents';
  
  public function hero()
  {
    $this->belongsTo('App\Models\Hero');
  }

  public function builds()
  {
    return $this->belongsToMany('App\Models\Build');
  }
}
