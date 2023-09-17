<?php

namespace Controllers;

use Mpdf\Mpdf;
use MVC\Router;
use Model\Venta;
use Exception;

class VentaController
{
    public static function index(Router $router)
    {
        $router->render('ventas/index', []);
    }


    // public static function buscarAPI()
    // {

    //     $venta_fecha = $_GET['venta_fecha'];
    //     //$fechaFin = $_GET['fechaFin'];


    //     $sql = "
    //     SELECT
    //     v.venta_fecha AS fecha,
    //     dv.detalle_cantidad AS cantidad,
    //     p.producto_nombre AS producto,
    //     c.cliente_nombre AS cliente
    // FROM
    //     ventas v
    //     INNER JOIN detalle_ventas dv ON v.venta_id = dv.detalle_venta
    //     INNER JOIN productos p ON dv.detalle_producto = p.producto_id
    //     INNER JOIN clientes c ON v.venta_cliente = c.cliente_id;";



    //     try {
    //         // Ejecutar la consulta SQL para obtener datos de ventas
    //         $ventas = Venta::fetchArray($sql);
    //         //[
    //             // 'fechaInicio'=>$fechaInicio, 
    //             // 'fechaFin'=>$fechaFin]);

    //         echo json_encode($ventas);
    //     } catch (Exception $e) {
    //         echo json_encode([
    //             'detalle' => $e->getMessage(),
    //             'mensaje' => 'Ocurrió un error',
    //             'codigo' => 0
    //         ]);
    //     }
    // }

    public static function buscarAPI()
    {
        $venta_fecha_inicio = $_GET['venta_fecha_inicio'];
        $venta_fecha_fin = $_GET['venta_fecha_fin'];
        // Formatear las fechas en el formato YYYY-MM-DD
        // Formatear las fechas en el formato YYYY-MM-DD HH:MM
        $fechaInicioFormateada = date('Y-m-d H:i', strtotime($venta_fecha_inicio));
        $fechaFinFormateada = date('Y-m-d H:i', strtotime($venta_fecha_fin));

        // Construir la consulta SQL utilizando las fechas formateadas
        $sql = "
    SELECT
        v.venta_fecha AS fecha,
        dv.detalle_cantidad AS cantidad,
        p.producto_nombre AS producto,
        c.cliente_nombre AS cliente
    FROM
        ventas v
        INNER JOIN detalle_ventas dv ON v.venta_id = dv.detalle_venta
        INNER JOIN productos p ON dv.detalle_producto = p.producto_id
        INNER JOIN clientes c ON v.venta_cliente = c.cliente_id
    WHERE
        v.venta_fecha BETWEEN '{$fechaInicioFormateada}' AND '{$fechaFinFormateada}'";

        try {
            // Ejecutar la consulta SQL para obtener datos de ventas en el rango de fechas.
            $ventas = Venta::fetchArray($sql);
    
            // Crear una respuesta JSON con los resultados o un mensaje de "No se encontraron registros"
            // $response = empty($ventas) ?
            //     [
            //         'mensaje' => 'No se encontraron registros',
            //         'codigo' => 1
            //     ] :
            //     $ventas;
            echo json_encode($ventas);
    
            //echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    
 }    