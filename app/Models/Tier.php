<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    protected $fillable = ['name'];

    public function heroes()
    {
        return $this->belongsToMany('App\Models\Hero');
    }
}
