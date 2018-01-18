<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::orderby('id', 'DESC')->where('status','DRAFT')->paginate(5);
        return view('posts', compact('posts'));
     

    }
}
