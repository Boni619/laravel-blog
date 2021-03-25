<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['namespace' => 'Auth'], function () {

  Route::get('/', ['as' => 'login-form', 'uses' => 'LoginController@showLoginForm']);
  Route::get('/login', ['as' => 'login-form', 'uses' => 'LoginController@showLoginForm']);

  Route::post('/login', ['as' => 'login', 'uses' => 'LoginController@login']);
  Route::post('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

  Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
  Route::post('register', 'RegisterController@register');


  Route::get('/admin', ['as' => 'admin-login-form', 'uses' => 'LoginController@showAdminLoginForm']);
  Route::get('/admin/login', ['as' => 'admin-login-form', 'uses' => 'LoginController@showAdminLoginForm']);

  Route::post('admin/login', ['as' => 'admin-login', 'uses' => 'LoginController@adminLogin']);
  Route::post('admin/logout', ['as' => 'admin-logout', 'uses' => 'LoginController@adminLogout']);

  // Password Reset Routes...
  Route::post('password/email', ['as' => 'password.email', 'uses' => 'ForgotPasswordController@sendResetLinkEmail']);
  Route::get('password/reset', ['as' => 'password.request', 'uses' => 'ForgotPasswordController@showLinkRequestForm']);
  Route::post('password/reset', ['as' => '', 'uses' => 'ResetPasswordController@reset']);
  Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'ResetPasswordController@showResetForm']);
});

// user routes
Route::group(['namespace' => 'User', 'prefix' => 'user', 'middleware' => ['auth', 'role:user']], function () {
  Route::get('dashboard', 'DashboardController@index')->name('user-dashboard');
  Route::resource('blog', 'PostController');
  Route::resource('comment', 'CommentController');
});

// admin routes
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'role:super_admin']], function () {
  /**dashbord routes**/
  Route::get('dashboard', 'DashboardController@index')->name('admin-dashboard');
  Route::get('users/data-list', 'UserController@usersListDataTable')->name('users-datatable-list');
  Route::resource('users', 'UserController');

  Route::get('posts/data-list', 'PostController@postsListDataTable')->name('posts-datatable-list');
  Route::resource('posts', 'PostController');

  Route::get('comments/data-list', 'CommentController@commentsListDataTable')->name('comments-datatable-list');
  Route::resource('comments', 'CommentController');
});
