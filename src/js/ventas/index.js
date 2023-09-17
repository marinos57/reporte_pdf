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
        
            generarPDF(data);
        }
    } catch (error) {
        console.log(error);
    }
};



const generarPDF = async (datos) => {
    const url = `/reporte_pdf/reporte/generarPDF`;

    const config = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(datos),
    };

    try {
        const respuesta = await fetch(url, config);

        if (respuesta.ok) {
            const blob = await respuesta.blob();

            if (blob) {
                const urlBlob = window.URL.createObjectURL(blob);

                // Abre el PDF en una nueva ventana o pestaña
                window.open(urlBlob, '_blank');
            } else {
                console.error('No se pudo obtener el blob del PDF.');
            }
        } else {
            console.error('Error al generar el PDF.');
        }
    } catch (error) {
        console.error(error);
    }
};



btnBuscar.addEventListener('click', buscar)