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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'UserLessonController@index')->name('home');
Route::get('add/lessons/{id}','UserLessonController@store')->name('add_user_lesson');
Route::get('remove/lessons/{id}','UserLessonController@destroy')->name('remove_user_lesson');

Route::get('admin', 'AdminController@index')->name('admin');
Route::get('admin/user/{id}', 'AdminController@show')->name('admin_user');

Route::post('add/user', 'AdminController@userStore')->name('add_user');
Route::post('delete/user', 'AdminController@userDestroy')->name('delete_user');
Route::post('search/user', 'AdminController@userShow')->name('search_user');

Route::get('admin/add/lessons/{userId}/{lessonId}', 'AdminController@lessonStore')->name('admin_add_lesson');
Route::get('admin/remove/lessons/{userId}/{lessonId}', 'AdminController@lessonDestroy')->name('admin_remove_lesson');
