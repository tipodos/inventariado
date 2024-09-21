@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>movimiento</h1>
@stop

@section('content')
<div class="container">
    <div class="form-wrapper">
        <h2>Agregar movimiento</h2>
        <form action="{{route('movimiento.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            
            <hr>
            <h5>Agregar materiales</h5>
            <div id="prendas-container">
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="categoria[]">Categoria</label>
                        <select name="categoria[]" class="form-control select2 categoria-select" id="categoria-select" required>
                            <option value="">Seleccione una categoría</option>
                            @foreach ($categoria as $cate)
                                <option value="{{ $cate->id }}">
                                    {{ $cate->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="material[]">Material</label>
                        <select name="material[]" class="form-control select2 material-select" id="material-select" required>
                            <option value="">Seleccione una material</option>
                            @foreach ($material as $mate)
                                <option value="{{ $mate->id }}" data-categoria-id="{{ $mate->categoria_id }}" data-price="{{ $mate->precio }}">
                                    {{ $mate->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="cantidad[]">Cantidad</label>
                        <input type="number" name="cantidad[]" class="form-control cantidad" value="0" min="0" required>
                    </div>
                    <div class="col-md-3">
                        <label for="total[]">Total</label>
                        <input type="text" name="total[]" class="form-control total" value="0.00" readonly required>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger remove-row mt-4">borrar</button>
                    </div>
                </div>
            </div>
            <button type="button" id="add-row" class="btn btn-secondary">Agregar Prenda</button>
            <hr>
            <div class="form-group">
                <label for="total-pagar">Total a Pagar</label>
                <input type="text" name="total_pagar" class="form-control" id="total-pagar" readonly required>
            </div>
            <input type="hidden" name="accion" id="accion" value="entrada">
            <button type="submit" class="btn btn-primary" onclick="document.getElementById('accion').value='entrada';">Entrada</button>
            <button type="submit" class="btn btn-primary" onclick="document.getElementById('accion').value='salida';">Salida</button>
        </form>
    </div>
</div>
@stop


@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        $(document).ready(function() {
    let allMaterials = [];

    // Guardar todas las opciones de materiales al inicio
    $('#material-select option').each(function() {
        allMaterials.push($(this).clone());
    });
    $(document).on('change', '.material-select, .cantidad', function() {
    const $row = $(this).closest('.row');
    const price =  parseFloat($row.find('.material-select option:selected').data('price')) || 0;
    const quantity = parseInt($row.find('.cantidad').val()) || 0;

    const total = price * quantity;
    $row.find('.total').val(total.toFixed(2));
    
    updateTotalPagar();
});

function updateTotalPagar() {
    let totalPagar = 0;
    $('.total').each(function() {
        totalPagar += parseFloat($(this).val()) || 0;
    });
    $('#total-pagar').val(totalPagar.toFixed(2));
}

    // Función para inicializar el filtrado de select por categoría
    function initializeSelectFiltering(row) {
        const categoriaSelect = row.find('.categoria-select');
        const materialSelect = row.find('.material-select');
    
        categoriaSelect.on('change', function() {
            const selectedCategoriaId = $(this).val();

            // Limpiar opciones del select de materiales
            materialSelect.empty();

            // Filtrar materiales basados en la categoría seleccionada
            allMaterials.forEach(function(material) {
                if (material.data('categoria-id') == selectedCategoriaId || selectedCategoriaId === "") {
                    materialSelect.append(material.clone());
                }
            });

            // Refrescar Select2 si está siendo usado
            if (materialSelect.hasClass('select2')) {
                materialSelect.trigger('change.select2');
            }
        });

        // Forzar el filtrado inicial según la categoría seleccionada
        categoriaSelect.trigger('change');
    }

    // Inicializar el filtrado para la primera fila
    initializeSelectFiltering($('#prendas-container .row:first'));

    // Clonar una nueva fila al hacer clic en el botón
    $('#add-row').click(function() {
        const $row = $('#prendas-container .row:first').clone();

        // Resetear los selectores
        $row.find('.material-select').empty().append(allMaterials.map(function(material) {
            return material.clone();
        }));

        $row.find('input').val('');
        $row.find('.total').val('0.00');
        
        // Agregar la nueva fila al contenedor
        $('#prendas-container').append($row);

        // Inicializar el filtrado para la nueva fila
        initializeSelectFiltering($row);
    });

    // Eliminar una fila
    $(document).on('click', '.remove-row', function() {
        $(this).closest('.row').remove();
    });
});
    </script>
@stop