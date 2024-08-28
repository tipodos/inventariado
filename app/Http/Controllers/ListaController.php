<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Detalle_movi;
use App\Models\Material;
use App\Models\movimiento;
use Illuminate\Http\Request;

class ListaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detalle = Detalle_movi::all();
        $movi =movimiento::all();
        $mate = Material::all();
        $cate = Category::all();

        return view('lista/lista',compact('detalle','movi','mate','cate'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movi = movimiento::find($id);
        $detalle = Detalle_movi::where('movimiento_id', $movi->id)->get();
        

        return view('lista/show',compact('movi', 'detalle'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
