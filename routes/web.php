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
    Route::post('categories', 'CategoryController@store');    
    Route::post('categories/{category}', 'CategoryController@update');
    Route::get('categories/{category}/edit', 'CategoryController@edit');
    Route::post('categories/{category}', 'CategoryController@destroy');

    Route::resource('tags', 'TagController');
    Route::get('get-tags','TagController@getTags');
    Route::post('tags', 'TagController@store');    
    Route::post('tags/{tag}', 'TagController@update');
    Route::get('tags/{tag}/edit', 'TagController@edit');
    Route::post('tags/{tag}', 'TagController@destroy');

    Route::resource('rols', 'RolController');
    Route::get('get-rols','RolController@getRols');
    Route::post('rols', 'RolController@store');    
    Route::post('rols/{rol}', 'RolController@update');
    Route::get('rols/{rol}/edit', 'RolController@edit');
    Route::post('rols/{rol}', 'RolController@destroy');

    Route::resource('articles', 'PostController');
    Route::get('summernote', 'FileController@getSummernote');
    Route::post('summernote', 'FileController@postSummernote')->name('summernote.post');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('articles', 'PostController');
    Route::get('article/destroy/{id}', ['as' => 'articles.get.destroy', 'uses' => 'PostController@destroy']);

});





