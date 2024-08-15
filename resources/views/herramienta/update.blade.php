@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Herramienta</h1>
@stop

@section('content')
<div class="container">
    <p>Actualizar Herramienta</p>
    <form action="{{ route('herramienta.update',['id'=>$herramienta_id->id])}}" method="post" class="mb-4">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de la herramienta" value="{{$herramienta_id->nombre}}">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="cantidad" min="0" value="{{$herramienta_id->cantidad}}">
            <label for="estado">Descompuesto</label>
            <input type="number" name="estado" id="estado" class="form-control" placeholder="Descompuesto" min="0" value="{{$herramienta_id->status}}">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
    </form>

    <h3>Lista de Categorías</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Herramienta</th>
                <th>Cantidad</th>
                <th>descompuesto</th>
                <th>--</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($herramienta as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>{{ $item->status }}</td>

                    <td><a href="# " class="btn btn-warning">Editar</a>
                        <form action="#" method="post" style="display:inline;">
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