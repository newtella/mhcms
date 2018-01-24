<?php

namespace App\Http\Controllers;

use App\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $roles = Rol::orderby('id','DESC')->paginate(5);
        return view('auth.dashboard.rols.index', compact('roles'));

    }



    public function getRols()
    {
        $rols = Rol::orderby('id','DESC')->get();
        return $rols;

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
            
            $rols = Rol::create($request->all());
            return $rols;
            
        }      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function show(Rol $rol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if($request->ajax())
        {
            
            $rols = Rol::find($request->id);
            return response($rols);
            
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->ajax())
        {
            
            $rols = Rol::find($request->id);
            $rols->update($request->all());
            return response($rols);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax())
        {   
            Rol::destroy($request->id);
            return redirect('rols')->with('status', 'Rol eliminado exitosamente');
        }
    }
    
}
