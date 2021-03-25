<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Comment;
use Yajra\DataTables\Facades\DataTables;


class CommentController extends Controller
{

  public function commentsListDataTable()
  {
    $query = Comment::with('post')->latest()->get();

    return Datatables::of($query)
      ->addColumn('title', function ($query) {
        return $query->post->title;
      })->addColumn('message', function ($query) {
        return $query->message;
      })
      ->addColumn('comment_by', function ($query) {
        return getUserName($query->user_id);
      })
      ->addColumn('created_at', function ($query) {
        return  date('d/m/Y h:i:s', strtotime($query->created_at));
      })->addColumn('action', function ($query) {
        return view('admin.include.comment-action', ['comment' => $query]);
        //  return 'Comming Soon';
      })
      ->escapeColumns([])
      ->make(true);
  }

  public function index()
  {
    return view('admin.comment.index');
  }


  // public function edit($id)
  // {
  //   $post = Post::where('id', $id)->first();
  //   return view('admin.post.edit', compact('post'));
  // }


  // public function update(Request $request)
  // {
  //   // dd($request->toArray());

  //   request()->validate([
  //     'title' => 'required',
  //     'description' => 'required',
  //   ]);

  //   Post::where('id', $request->id)->update(['title' => $request->title, 'description' => $request->description]);

  //   return redirect()->route('posts.index')
  //     ->with('success', 'Post updated successfully');
  // }

  public function destroy($id)
  {

    Comment::where('id', $id)->delete();

    return redirect()->route('comments.index')
      ->with('success', 'Comment Deleted successfully');
  }
}
