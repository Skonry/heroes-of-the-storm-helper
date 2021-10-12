<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Build;
use App\Models\BuildUpvote;

class BuildUpvoteController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function store(Request $request, $buildId)
  {
    if (Auth::id() === $buildId) {
      return response()->json([
        'result' => 'Author cannot upvote own build.'
      ], 403);
    }

    BuildUpvote::create([
      'user_id' => Auth::id(),
      'build_id' => $buildId
    ]);
    
    return response()->json([
      'result' => 'ok'
    ]);
  }
}