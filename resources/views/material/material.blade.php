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
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nro</th>
                <th>material</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Categoria</th>
                <th>--</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($material as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>{{ $item->precio }}</td>
                    <td>{{ $item->categoria->nombre }}</td>
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
</div>  
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop