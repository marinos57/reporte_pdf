<h1 class="text-center">BUSQUEDA DE VENTAS POR FECHA EN UN RANGO DETERMINADO</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioVenta">
        <div class="row mb-3">
            <div class="col">
                <label for="venta_fecha_inicio">Fecha de Inicio</label>
                <span>Ingrese una fecha de inicio</span>
                <input type="datetime-local" name="venta_fecha_inicio" id="venta_fecha_inicio" class="form-control">
            </div>
            <div class="col">
                <label for="venta_fecha_fin">Fecha de Fin</label>
                <span>Ingrese una fecha mayor a la anterior</span>
                <input type="datetime-local" name="venta_fecha_fin" id="venta_fecha_fin" class="form-control">
            </div>
            <div class="row mb-3 mt-5">
                <div class="col">
                    <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
                </div>
            </div>
    </form>
</div>

<script src="build/js/ventas/index.js"></script>