<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Detalle_movi;
use App\Models\Material;
use App\Models\movimiento;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoria = Category::all();
        $material= Material::all();
        $movimiento = movimiento::all();

        return view('movimiento/movimiento',compact('categoria','material','movimiento'));
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
        $material = $request->input('material');
        $cantidades = $request->input('cantidad');
        $accion = $request->input('accion');

        $movi= new movimiento();
        $movi->accion = $accion;
        $movi->nombre=$request->input('nombre');
        $movi->total=$request->input('total_pagar');
        $movi->save();


        foreach ($material as $key => $material_id) {
            $detalle = new Detalle_movi();
            $detalle->movimiento_id = $movi->id;
            $detalle->material_id = $material_id;
            $detalle->cantidad = $cantidades[$key];
            $detalle->save();

            $material = Material::find($material_id);
            
            if($accion == 'entrada'){
                $material->cantidad += $cantidades[$key];
                
            }elseif($accion == 'salida'){
                $material->cantidad -=$cantidades[$key];
                
            }
            $material->save();
            
        } 
        
        return redirect()->route('movimiento.index')->with('success', 'Personal created successfully.');
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
