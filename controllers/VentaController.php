<?php

namespace Controllers;

use Mpdf\Mpdf;
use MVC\Router;
use Model\Venta;

class VentaController {
    public static function index(Router $router){
        $router->render('ventas/index', []);
        
    }
}