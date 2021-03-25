<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Yajra\DataTables\Facades\DataTables;


class PostController extends Controller
{

  public function postsListDataTable()
  {
    $query = Post::latest()->get();

    return Datatables::of($query)
      ->addColumn('title', function ($query) {
        return $query->title;
      })->addColumn('description', function ($query) {
        return str_limit($query->description);
      })->addColumn('status', function ($query) {
        return ($query->status == 1 ? '<button type="button" class="btn btn-success"  style="
    height: 35px;
    width: 88px;
    padding-top: 2px;
">Active</button>' : '<button type="button" class="btn btn-danger"  style="
    height: 35px;
    width: 88px;
    padding-top: 2px;
">In-active</button>');
      })->addColumn('created_at', function ($query) {
        return  date('d/m/Y h:i:s', strtotime($query->created_at));
      })->addColumn('action', function ($query) {

        return view('admin.include.post-action', ['post' => $query]);
        //  return 'Comming Soon';
      })
      ->escapeColumns([])
      ->make(true);
  }

  public function index()
  {
    return view('admin.post.index');
  }


  public function edit($id)
  {
    $post = Post::where('id', $id)->first();
    return view('admin.post.edit', compact('post'));
  }


  public function update(Request $request)
  {
    // dd($request->toArray());

    request()->validate([
      'title' => 'required',
      'description' => 'required',
    ]);

    Post::where('id', $request->id)->update(['title' => $request->title, 'description' => $request->description]);

    return redirect()->route('posts.index')
      ->with('success', 'Post updated successfully');
  }

  public function destroy($id)
  {

    Post::where('id', $id)->delete();

    return redirect()->route('posts.index')
      ->with('success', 'Post Deleted successfully');
  }
}
