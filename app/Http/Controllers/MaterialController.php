<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = $request->get('buscar');
        $material = Material::where('nombre', 'like', "%$buscar%")->orWhereHas(
            'categoria', function($query) use ($buscar){
                $query->where('nombre', 'like', "%$buscar%");
            }
        )->get();
        $precioTotal = $material->sum(function($materiales){
            return $materiales->cantidad * $materiales->precio;
        });
        $categoria = Category::all();

        return view('material/material', compact('material','categoria', 'precioTotal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $material = new Material();
        $material->nombre=$request->nombre;
        $material->cantidad=$request->cantidad;
        $material->precio=$request->precio;
        $material->categoria_id=$request->categoria;
        $material->save();

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
        $material_id = Material::find($id);
        $material = Material::all();
        $categoria = Category::all();

        return view('material/update',compact('material_id','material','categoria'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $material = Material::find($id);
        $material->nombre = $request->nombre;
        $material->cantidad = $request->cantidad;
        $material->precio = $request->precio;
        $material->categoria_id = $request->categoria;
        $material->save();

        return redirect()->route('material.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = Material::find($id);
        $material->delete();

        return redirect()->back();
    }
}
