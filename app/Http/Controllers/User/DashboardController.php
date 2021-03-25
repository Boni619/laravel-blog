<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $posts = Post::where('status', 1)->whereHas('user', function ($q) {
      $q->where('status', STATUS_ACTIVE);
    })->get();
    return view('user.dashboard', compact('posts'));
  }
}
