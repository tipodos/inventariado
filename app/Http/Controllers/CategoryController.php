<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use function Pest\Laravel\delete;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoria= Category::all();
        return view('categoria/categoria',compact('categoria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoria = new Category();
        $categoria->nombre = $request->nombre;
        $categoria->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoria_id= Category::find($id);
        $categoria= Category::all();

        return view('categoria/update',compact('categoria','categoria_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categoria_id= Category::find($id);
        $categoria_id->nombre=$request->nombre;
        $categoria_id->save();

        return redirect()->route('categoria.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria= Category::find($id);
        $categoria->delete();
        return redirect()->back();
    }
}
