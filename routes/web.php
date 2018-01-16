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

use App\Post;
use App\Http\Controllers\FileController;




Route::get('/', function () {
    $posts = Post::orderby('id', 'DESC')->where('status','DRAFT')->simplePaginate(5);
    return view('welcome', compact('posts'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('categories', 'CategoryController');
Route::resource('rols', 'RolController');
Route::resource('articles', 'PostController');

Route::get('summernote', 'FileController@getSummernote');
Route::post('summernote', 'FileController@postSummernote')->name('summernote.post');

