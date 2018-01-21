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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;




Route::get('/', function () {
    $posts = Post::orderby('id', 'DESC')->where('status','DRAFT')->simplePaginate(5);
    return view('welcome', compact('posts'));
});
Route::get('{category}/{articleslug}', 'HomeController@getArticle');





Auth::routes();

// en las siguientes rutas si no esta logeado mandar a login
Route::group(['middleware' => ['auth']], function() {
   
    Route::resource('categories', 'CategoryController');
    Route::get('get-categories','CategoryController@getCategories');
    Route::post('categories/destroy/{id}', 'CategoryController@destroy');
    Route::resource('rols', 'RolController');
    Route::resource('articles', 'PostController');
    Route::get('summernote', 'FileController@getSummernote');
    Route::post('summernote', 'FileController@postSummernote')->name('summernote.post');
    Route::get('/home', 'HomeController@index')->name('home');
});





