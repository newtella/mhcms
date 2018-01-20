<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        return view('home');
    }

    public function getArticle($category, $articleslug)
    {
        
        $articulo = Post::where('slug',$articleslug)->first();
        $similarpost = Category::where('slug', $category)->first()->posts->take(5)->get();    
        return view('post', compact('articulo','similarpost'));

    }
}
