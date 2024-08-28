@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container">
    <h2 class="my-4">Detalles del Movimiento</h2>

    <div class="card">
        <div class="card-header">
            Información del Movimiento
        </div>
        <div class="card-body">
            <p><strong>ID del Movimiento:</strong> {{ $movi->id }}</p>
            <p><strong>Nombre:</strong> {{ $movi->nombre }}</p>
            <p><strong>Acción:</strong> 
                <span class="badge badge-{{ $movi->accion == 'entrada' ? 'success' : 'danger' }}">
                    {{ ucfirst($movi->accion) }}
                </span>
            </p>
            <p><strong>Total:</strong> S/. {{ number_format($movi->total, 2) }}</p>
            <p><strong>Fecha de Registro:</strong> {{ $movi->created_at->format('d-m-Y H:i:s') }}</p>
        </div>
    </div>

    <h3 class="my-4">Productos Asociados</h3>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalle as $item)
                @php
                    $material = $item->material;
                    $precioTotal = $material->precio * $item->cantidad;
                @endphp
                <tr>
                    <td>{{ $material->nombre }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>S/. {{ number_format($material->precio, 2) }}</td>
                    <td>S/. {{ number_format($precioTotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop