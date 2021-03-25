<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\Facades\DataTables;
use Alert;


class UserController extends Controller
{

  public function usersListDataTable()
  {
    $query = User::role(ROLE_USER)->latest()->get();

    return Datatables::of($query)
      ->addColumn('name', function ($query) {
        return $query->name;
      })->addColumn('email', function ($query) {
        return $query->email;
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

        return view('admin.include.user-action', ['user' => $query]);
        //  return 'Comming Soon';
      })
      ->escapeColumns([])
      ->make(true);
  }

  public function index()
  {
    return view('admin.user.index');
  }


  public function edit($id)
  {
    $user = User::where('id', $id)->first();
    return view('admin.user.edit', compact('user'));
  }


  public function update(Request $request)
  {

    request()->validate([
      'name' => 'required',
    ]);

    User::where('id', $request->id)->update(['name' => $request->name, 'status' => $request->status]);

    return redirect()->route('users.index')
      ->with('success', 'User updated successfully');
  }

  public function destroy($id)
  {

    $user = User::where('id', $id)->first();
    $user->removeRole(ROLE_USER);
    User::where('id', $id)->delete();

    return redirect()->route('users.index')
      ->with('success', 'User Deleted successfully');
  }
}
