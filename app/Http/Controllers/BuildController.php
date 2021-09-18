<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Build;
use Inertia\Inertia;

class BuildController extends Controller
{
  public function index()
  {
    $builds = Build::all();

    return Inertia::render('Builds', [
      'builds' => $builds
    ]);
  }

  public function show($id)
  {
    $build = Build::find($id);

    return Inertia::render('Build', [
      'build' => $build
    ]);
  }
}
