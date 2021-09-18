<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Hero;
use App\Models\TierList;
use Inertia\Inertia;

class TierListController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth')->except('index', 'show');
  }

  public function index() 
  {
    $tierLists = TierList::all();

    return Inertia::render('TierLists/TierLists', [
      'tierLists' => $tierLists->map(function ($tierList) {
        return [
          'id' => $tierList->id,
          'name' => $tierList->name,
          'updatedAt' => substr($tierList->updated_at, 0, 10),
          'userName' => $tierList->user->name,
          'upvotesCount' => $tierList->upvotes()->count()
        ];
      })
    ]);
  }
  
  public function create() 
  {
    $heroes = Hero::all();

    return Inertia::render('TierLists/CreateTierList', [
      'heroes' => $heroes
    ]);
  }

  public function store(Request $request)
  {
    $tierList = TierList::create([
      'user_id' => Auth::id(),
      'name' => $request->tier_list_name
    ]);
    foreach($request->tiers as $tierInput)
    {
      $tier = $tierList->tiers()->create([
        'name' => $tierInput['name']
      ]);
      $tier->heroes()->attach($tierInput['heroes_ids']);
    }
    return redirect()->route('tier_lists.index');
  }

  public function show($tierListId)
  {
    $tierList = TierList::find($tierListId);
    $tiers = $tierList->tiers->map(function($tier) {
      return [
        'name' => $tier->name,
        'heroes' => $tier->heroes->map(function($hero) {
          return [
            'heroIconUrl' => url('/images/heroes', [$hero->icon])
          ];
        })
      ];
    });
    
    return Inertia::render('TierLists/TierList', [
      'tierListName' => $tierList->name,
      'tierListId' => $tierList->id,
      'tiers' => $tiers,
      'userIsOwner' =>  Auth::id() == $tierList->user->id
    ]);
  }

  public function edit($tierListId)
  {
    $tierList = TierList::with('tiers.heroes')->find($tierListId);
    $heroes = Hero::all();

    return Inertia::render('TierLists/EditTierList', [
      'heroes' => $heroes,
      'tierList' => $tierList
    ]);
  }
  
  public function update(Request $request, $tierListId)
  {
    $tierList = TierList::find($tierListId);
    $tierList->update(['name' => $request->name]);
    $tierList->tiers()->each(function ($tier) {
      $tier->heroes()->detach();
      $tier->delete();
    });
    foreach($request->tiers as $tierInput) 
    {
      $tier = $tierList->tiers()->create([
        'name' => $tierInput['name']
      ]);
      $tier->heroes()->attach($tierInput['heroes_ids']);
    }

    return redirect()->route('tier_lists.index');
  }

  public function destroy(Request $request, $tierListId)
  {
    $tierList = TierList::find($tierListId);

    $tierList->tiers()->each(function ($tier) {
      $tier->heroes()->detach();
      $tier->delete();
    });

    $tierList->delete();

    return redirect()->route('tier_lists.index');
  }

  private function findElementWithGivenColumnValue($array, $column, $value) {
    $key = array_search($value, array_column($array, $column));

    if ($key === false) 
    {
      return $key;
    }

    return $array[$key];
  }
}
