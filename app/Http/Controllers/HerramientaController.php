<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;

class HerramientaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $herramienta= Tool::all();
        return view('herramienta/herramienta',compact('herramienta'));
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
        $herramienta = new Tool();
        $herramienta->nombre= $request->nombre;
        $herramienta->cantidad= $request->cantidad;
        $herramienta->status= $request->estado;
        $herramienta->save();

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
        $herramienta_id = Tool::find($id);
        $herramienta= Tool::all();

        return view('herramienta/update', compact('herramienta_id','herramienta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $herramienta = Tool::find($id);
        $herramienta->nombre = $request->nombre;
        $herramienta->cantidad = $request->cantidad;
        $herramienta->status = $request->estado;

        $herramienta->save();

        return redirect()->route('herramienta.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $herramienta = Tool::find($id);
        $herramienta->delete();
        return redirect()->back();
    }
}
