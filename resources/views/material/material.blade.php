@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container">
    <p>Materia</p>
    <form action="{{ route('material.store') }}" method="post" class="mb-4">
        @csrf
        <div class="form-group mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre del material" required>
        </div>
    
        <div class="form-group mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad" min="0" required>
        </div>
    
        <div class="form-group mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" id="precio" class="form-control" placeholder="Precio" min="0" required>
        </div>
    
        <div class="form-group mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-list"></i></span>
                <select name="categoria" id="categoria" class="form-select" required>
                    <option selected disabled>Selecciona una categoría</option>
                    @foreach ($categoria as $cate)
                    <option value="{{ $cate->id }}">{{ $cate->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>        
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
    <h3>Lista de materiales</h3>
    <form action="{{ route('material.index') }}" method="GET" class="d-flex justify-content-center align-items-center p-3 shadow-sm bg-light rounded">
        <div class="input-group w-50">
            <input type="text" name="buscar" id="buscar" placeholder="Buscar material..." class="form-control" value="{{ request()->get('buscar') }}" aria-label="Buscar material" aria-describedby="button-addon">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" id="button-addon">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </div>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nro</th>
                <th>material</th>
                <th>Categoria</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th>--</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($material as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->categoria->nombre }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>S/{{ $item->precio }}</td>
                    <td>S/{{$item->cantidad*$item->precio}}</td>
                    <td><a href="{{route('material.edit',['id'=>$item->id])}} " class="btn btn-warning">Editar</a>
                        <form action="{{route('material.delete',['id'=>$item->id])}}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        <h5>Precio total de todos los materiales: <strong>S/{{number_format($precioTotal,2)}}</strong></h5>
    </div>
</div>  
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop