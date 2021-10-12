<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Hero;
use App\Models\Build;
use Inertia\Inertia;

class HeroBuildController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth')->except('index', 'show');
  }
  
  public function index($heroId)
  {
    $hero = Hero::find($heroId);
    $builds = $hero->builds;
    
    return Inertia::render('HeroBuilds/HeroBuilds', [
      'hero' => $hero,
      'heroIconUrl' => url('/images/heroes', [$hero->icon]),
      'builds' => $builds->map(function ($build) {
        return [
          'id' => $build->id,
          'name' => $build->name,
          'updatedAt' => substr($build->updated_at, 0, 10),
          'userName' => $build->user->name,
          'upvotesCount' => $build->upvotes()->count()
        ];
      })
    ]);
  }

  public function create($heroId)
  {
    $hero = Hero::find($heroId);
    $talents = $hero->talents;

    return Inertia::render('HeroBuilds/CreateHeroBuild', [
      'hero' => $hero, 
      'talents' => $talents,
      'heroIconUrl' => url('/images/heroes', [$hero->icon])
    ]);
  }

  public function store(Request $request, $heroId)
  {
    $hero = Hero::find($heroId);
    $build = $hero->builds()->create([
      'user_id' => Auth::id(),
      'name' => $request->buildName
    ]);
    $build->talents()->attach($request->talentsIds);
    
    return redirect()->route('heroes.builds.index', $heroId);
  }

  public function show($heroId, $buildId)
  {
    $hero = Hero::find($heroId);
    $build = Build::find($buildId);
    $talents = $hero->talents->map(function ($heroTalent) use ($build) {
      if ($build->talents->contains($heroTalent->id))
      {
          $heroTalent->isSelected = true;
      } else
      {
          $heroTalent->isSelected = false;
      }
      return $heroTalent;
    });
    $numberOfUpvotes = $build->upvotes()->count();
    $isUpvoted = $build->upvotes()->where('user_id', Auth::id())->exists();
    $isAuthenticated = Auth::check();

    return Inertia::render('HeroBuilds/HeroBuild', [
      'hero' => $hero, 
      'build' => $build, 
      'talents' => $talents,
      'numberOfUpvotes' => $numberOfUpvotes,
      'isAuthenticated' => $isAuthenticated,
      'isUpvoted' => $isUpvoted,
      'userIsOwner' => Auth::id() == $build->user->id ? true : false
    ]);
  }

  public function edit($heroId, $buildId)
  {
    $hero = Hero::find($heroId);
    $build = Build::find($buildId);

    $talents = $hero->talents->map(function ($heroTalent) use ($build) {
      if ($build->talents->contains($heroTalent->id))
      {
          $heroTalent->isSelected = true;
      } else
      {
          $heroTalent->isSelected = false;
      }
      return $heroTalent;
    });

    return Inertia::render('HeroBuilds/EditHeroBuild', [
      'hero' => $hero, 
      'build' => $build, 
      'talents' => $talents
    ]);
  }

  public function update(Request $request, $heroId, $buildId)
  {
    if (Auth::id() !== $buildId) {
      return response()->json([
        'result' => 'Only author can edit own build.'
      ], 403);
    }

    $build = Build::find($buildId);
    $build->name = $request->buildName;
    $build->talents()->detach();
    $build->talents()->attach($request->talentsIds);

    return redirect()->route('heroes.builds.index', $heroId);
  }

  public function destroy($heroId, $buildId)
  {
    if (Auth::id() !== $buildId) {
      return response()->json([
        'result' => 'Only author can delete own build.'
      ], 403);
    }

    $build = Build::find($buildId);
    $build->talents()->detach();
    $build->delete();

    return redirect()->route('heroes.builds.index', $heroId);
  }
}
