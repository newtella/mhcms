<?php

namespace App\Http\Controllers;
use DB;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responses
     */
    public function index()
    {
        $categories = Category::orderby('id','DESC')->paginate(5);
        return view('auth.dashboard.categories.index', compact('categories'));

    }

    public function getCategories()
    {
        $categories = Category::orderby('id','DESC')->get();
        return $categories;

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
            
            $categories = Category::create($request->all());
            return $categories;
            
        }
    }
 

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if($request->ajax())
        {
            
            $categories = Category::find($request->id);
            return response($categories);
            
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->ajax())
        {
            
            $categories = Category::find($request->id);
            $categories->update($request->all());
            return response($categories);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax())
        {   
            Category::destroy($request->id);
            return redirect('categories')->with('status', 'Categoria eliminada exitosamente');
        }
    }
}
