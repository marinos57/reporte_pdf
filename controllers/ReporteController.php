<?php
namespace Controllers;

use Mpdf\Mpdf;
use MVC\Router;
use Model\Venta;
use Exception;

class ReporteController {
    public static function pdf(Router $router){
        $venta_fecha_inicio = $_GET['venta_fecha_inicio'];
        $venta_fecha_fin = $_GET['venta_fecha_fin'];

        // Obtener los datos de ventas utilizando la función buscarAPI de VentaController
        $ventas = VentaController::buscarAPI($venta_fecha_inicio, $venta_fecha_fin);

        // Crear un objeto mPDF
        $mpdf = new Mpdf([
            "orientation" => "P",
            "default_font_size" => 12,
            "default_font" => "arial",
            "format" => "Letter",
            "mode" => 'utf-8'
        ]);
        $mpdf->SetMargins(30, 35, 25);

        // Cargar una vista HTML con los datos de ventas
        $html = $router->load('reporte/pdf', [
            'ventas' => $ventas
          
 // Pasa los datos de ventas a la vista
        ]);
        // var_dump($ventas);
        // exit();


        // Configurar encabezado y pie de página
        $htmlHeader = $router->load('reporte/header');
        $htmlFooter = $router->load('reporte/footer');
        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->SetHTMLFooter($htmlFooter);

        // Agregar el contenido HTML al PDF
        $mpdf->WriteHTML($html);

        // Generar el PDF y mostrarlo o descargarlo
        $mpdf->Output();
    }



    ///otra prueba



    public static function generarPDF(Router $router)
{
    $datos = json_decode(file_get_contents('php://input'));

    // Cargar una vista HTML con los datos
    $html = $router->load('reporte/pdf', [
        'ventas' => $datos // Pasa los datos directamente a la vista
    ]);




    // Crear un objeto mPDF
    $mpdf = new Mpdf();


    //tabla 

    // $html = '<table>';
    // foreach ($datos as $registro) {
    //     $html .= '<tr>';
    //     $html .= '<td>' . $registro->fecha . '</td>';
    //     $html .= '<td>' . $registro->cantidad . '</td>';
    //     $html .= '<td>' . $registro->producto . '</td>';
    //     $html .= '<td>' . $registro->cliente . '</td>';
    //     $html .= '</tr>';
    // }
    // $html .= '</table>';

    // Configurar encabezado y pie de página si es necesario
    $htmlHeader = $router->load('reporte/header');
    $htmlFooter = $router->load('reporte/footer');
    $mpdf->SetHTMLHeader($htmlHeader);
    $mpdf->SetHTMLFooter($htmlFooter);

    // Agregar el contenido HTML al PDF
    $mpdf->WriteHTML($html);

    // Generar el PDF y mostrarlo o descargarlo
    $mpdf->Output();
}

 }
////este si sirve se comento para probar
    // public static function generarPDF()
    // {
       
    //     $datos = json_decode(file_get_contents('php://input'));

    //     $html = include('reporte_pdf/reporte/pdf.php');
    //     // Crea un objeto mPDF
    //     $mpdf = new Mpdf();

    //     // Agrega el contenido HTML con los datos en una tabla
    //     $html = '<table>';
    //     foreach ($datos as $registro) {
    //         $html .= '<tr>';
    //         $html .= '<td>' . $registro->fecha . '</td>';
    //         $html .= '<td>' . $registro->cantidad . '</td>';
    //         $html .= '<td>' . $registro->producto . '</td>';
    //         $html .= '<td>' . $registro->cliente . '</td>';
    //         $html .= '</tr>';
    //     }
    //     $html .= '</table>';

    //     //Configura encabezado y pie de página
    //     // $htmlHeader = $router->load('reporte/header');
    //     // $htmlFooter = $router->load('reporte/footer');
    //     // $mpdf->SetHTMLHeader($htmlHeader);
    //     // $mpdf->SetHTMLFooter($htmlFooter);

    //     // Agrega el contenido HTML al PDF
    //     $mpdf->WriteHTML($html);

    //     // Generar el PDF y mostrarlo o descargarlo
    //     $mpdf->Output();
    // }



//     public static function generarPDF()
// {
//     // Ruta del PDF base existente
//     $pdfBasePath = 'reporte_pdf/reporte/pdf';

//     $datos = json_decode(file_get_contents('php://input'));

//     // Crea un objeto mPDF y carga el PDF base
//     $mpdf = new Mpdf();
//     $mpdf->SetImportUse();

//     // Agrega el contenido HTML con los datos en una tabla
//     $html = '<table>';
//     foreach ($datos as $registro) {
//         $html .= '<tr>';
//         $html .= '<td>' . $registro->fecha . '</td>';
//         $html .= '<td>' . $registro->cantidad . '</td>';
//         $html .= '<td>' . $registro->producto . '</td>';
//         $html .= '<td>' . $registro->cliente . '</td>';
//         $html .= '</tr>';
//     }
//     $html .= '</table>';



//     // Establece el contenido HTML en la página actual
//     $mpdf->WriteHTML($html);

//     // Importa el PDF base en la página actual
//     // $mpdf->SetSourceFile($pdfBasePath);
//     // $mpdf->AddPage();
//     // $tplId = $mpdf->ImportPage();
//     // $mpdf->UseTemplate($tplId);


//     // Generar el PDF y mostrarlo o descargarlo
//     $mpdf->Output();
// }

// }


