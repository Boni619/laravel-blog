<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class PostController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('blog-post');
  }

  public function create()
  {
    return view('user.blog.create');
  }


  public function store(Request $request)
  {

    $request->validate([
      'title' => 'bail|required|unique:posts|max:255',
      'description' => 'required',
    ]);

    Post::create([
      'title' => $request->title,
      'description' => $request->description,
      'user_id' => Auth::user()->id,
      'status' => 1
    ]);

    return redirect()->route('user-dashboard')
      ->with('success', 'Post Added successfully');
  }


  public function show($id)
  {
    $post = Post::where('id', $id)->with('comments')->first();

    $currentTime = Carbon::now();
    return view('user.blog.show', compact('post', 'currentTime'));
  }


  public function edit($id)
  {
    $post = Post::where('id', $id)->first();
    return view('user.blog.edit', compact('post'));
  }


  public function update(Request $request, Post $post)
  {
    $request->validate([
      'title' => 'bail|required|max:255',
      'description' => 'required',
    ]);

    Post::where('id', $request->id)->update([
      'title' => $request->title,
      'description' => $request->description,

    ]);

    return redirect()->route('user-dashboard')
      ->with('success', 'Post Updated successfully');
  }

  public function destroy($id)
  {
    Post::where('id', $id)->delete();
    return redirect()->route('user-dashboard')
      ->with('success', 'Post Updated successfully');
  }
}
