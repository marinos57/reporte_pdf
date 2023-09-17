import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion} from "../funciones";


const formulario = document.querySelector('form');
const btnBuscar = document.getElementById('btnBuscar');


const buscar = async () => {
    const venta_fecha_inicio = document.getElementById('venta_fecha_inicio').value;
    const venta_fecha_fin = document.getElementById('venta_fecha_fin').value;

    if (!venta_fecha_inicio || !venta_fecha_fin) {
        // Validación simple para asegurarte de que ambas fechas estén seleccionadas.
        Toast.fire({
            title: 'Por favor, seleccione ambas fechas.',
            icon: 'error'
        });
        return;
    }

    if (venta_fecha_inicio > venta_fecha_fin) {
        Toast.fire({
            title: 'La fecha de inicio no puede ser mayor que la fecha de fin.',
            icon: 'error'
        });
        return;
    }

    const url = `/reporte_pdf/API/ventas/buscar?venta_fecha_inicio=${venta_fecha_inicio}&venta_fecha_fin=${venta_fecha_fin}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        console.log(data);

        if (data.length === 0) {
            Toast.fire({
                title: 'No se encontraron registros',
                icon: 'info'
            });
        } else {
            Toast.fire({
                title: 'Se encontraron registros exitosamente',
                icon: 'success'
            });
        }
    } catch (error) {
        console.log(error);
    }
};



btnBuscar.addEventListener('click', buscar)