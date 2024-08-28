@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container">
<div class="col-md-8">
    <div class="table-wrapper">
        <h2>Lista de Personal</h2>
            <p>No se encontraron registros de personal.</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acción</th>
                        <th>total</th>
                        <th>--</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movi as $item)
                        <tr>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->accion }}</td>
                            <td>{{ $item->total }}</td>
                            <td>
                                <a href="{{route('lista.show',['id'=>$item->id])}} " class="btn btn-warning">ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
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