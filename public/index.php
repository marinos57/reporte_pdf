<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\ReporteController;
use Controllers\VentaController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);
$router->get('/ventas', [VentaController::class,'index']);
$router->get('/API/ventas/buscar', [VentaController::class,'buscarAPI'] );
$router->get('/pdf', [ReporteController::class,'pdf']);

$router->post('/reporte/generarPDF', [ReporteController::class, 'generarPDF']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
