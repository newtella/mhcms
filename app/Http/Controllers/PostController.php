<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Post::with('user','category')->orderBy('id','DESC')->paginate(5);
        $categories = Category::orderBy('id','DESC')->get();
        return view('auth.dashboard.articles.index', compact('articles','categories'));

    }

    public function getArticles()
    {
        $articles   = Post::with('user','category')->orderby('id','DESC')->get();
        return $articles;

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax())
        {
          
            $post = Post::create($request->all());

            if ($request->hasFile('imageurl')) {

                // $request->file('imageurl')->storeAs('public/upload');
                // // ensure every image has a different name
                // $file_name = $request->file('imageurl')->hashName();
                // // save new image $file_name to database
                // $post->update(['imageurl' => $file_name]);
                
                $destinationPath="upload";
                $file=$request->imageurl;
                $extension=$file->getClientOriginalExtension();
                $fileName=rand(1111,9999).".".$extension;
                $file->move($destinationPath, $fileName);
                $imageurl=$fileName;
            
            }
            return $post;
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if ($request->ajax())
        {
            $posts = Post::find($request->id);
            return response ($posts);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->ajax())
        {
            $posts = Post::find($request->id);
            $posts->update($request->all());
            return response ($posts);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        if ($request->ajax())
        {   
            Post::destroy($request->id);
            return redirect('articles')->with('status', 'Articulo eliminado exitosamente');
        }
    }

    
}
