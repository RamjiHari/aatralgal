<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function(){
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('categories' ,'CategoriesController')->middleware('admin');
	Route::resource('title' ,'TitleController')->middleware('admin');
	Route::resource('post' ,'PostsController')->middleware('admin');
	Route::resource('tags' ,'TagsController')->middleware('admin');
	Route::get('trashed_posts' ,'PostsController@trashed')->name('trashed-post.index')->middleware('admin');
	Route::put('restore_posts/{post}' ,'PostsController@restore')->name('restore-posts')->middleware('admin');
	Route::post('gettitle_post', 'GetContentController@gettitle')->name('gettitle-post.index');
	Route::post('getsidebartitle_post', 'GetContentController@getsidetitle')->name('getsidebartitle-post.index');
	Route::post('getcontent_post', 'GetContentController@getcontent')->name('getcontent-post.index');
	Route::get('users/profile','UsersController@edit')->name('users.edit-profile');
	Route::put('users/update','UsersController@update')->name('users.update-profile');
});
Route::middleware(['auth','admin'])->group(function(){
Route::get('users','UsersController@index')->name('users.index');
Route::post('users/{user}/make-admin' ,'UsersController@makeadmin')->name('users.make-admin');
});