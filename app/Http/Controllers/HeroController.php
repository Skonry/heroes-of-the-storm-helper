<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;
use Inertia\Inertia;

class HeroController extends Controller
{
  public function index()
  {
    $heroes = Hero::all();

    return Inertia::render('Heroes/Heroes', [
      'heroes' => $heroes->map(function ($hero) {
        return [
          'id' => $hero->id,
          'name' => $hero->name,
          'iconUrl' => url('/images/heroes', [$hero->icon])
        ];
      })
    ]);
  }

  public function show($id)
  {
    $hero = Hero::find($id);

    return Inertia::render('Heroes/Hero', [
      'hero' => $hero,
      'heroIconUrl' => url('/images/heroes', [$hero->icon])
    ]);
  }
}
