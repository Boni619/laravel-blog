<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Comment;
use Illuminate\Http\Request;


class CommentController extends Controller
{


  public function store(Request $request)
  {

    $request->validate([
      'user_id' => 'required',
      'post_id' => 'required',
      'message' => 'required|max:255',
    ]);

    $values = $request->except('_token');

    Comment::create($values);

    return redirect()->back()
      ->with('success', 'Comment Added successfully');
  }


  public function destroy($id)
  {
    Comment::where('id', $id)->delete();
    return redirect()->back()
      ->with('success', 'Post Updated successfully');
  }
}
