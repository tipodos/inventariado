@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Categoria</h1>
@stop

@section('content')
<div class="container">
    <p>Crear categoría</p>
    <form action="{{ route('categoria.store') }}" method="post" class="mb-4">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de la categoría">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Guardar</button>
    </form>

    <h3>Lista de Categorías</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Categoria</th>
                <th>--</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categoria as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td><a href="{{route('categoria.edit',['id'=>$item->id])}} " class="btn btn-warning">Editar</a>
                        <form action="{{route('categoria.delete',['id'=>$item->id])}}" method="post" style="display:inline;">
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