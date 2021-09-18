<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TierList;
use App\Models\TierListUpvote;

class TierListUpvoteController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function store(Request $request, $tierListId)
  {
    TierListUpvote::create([
      'user_id' => Auth::id(),
      'tier_list_id' => $tierListId
    ]);
    
    return response()->json([
      'result' => 'ok'
  ]);
  }
}
