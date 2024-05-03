<?php
/* Mostrar errores */
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', "C:/xampp/htdocs/peliculas/php_error_log");
/*Encabezada de las solicitudes*/
/*CORS*/
header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
/*--- Requerimientos Clases o librerías*/
require_once "models/MySqlConnect.php";

/***--- Agregar todos los modelos*/
require_once "models/MaterialModel.php";
require_once "models/CentroAcopioModel.php";
require_once "models/ProvinciaModel.php";
require_once "models/CantonModel.php";
require_once "models/DistritoModel.php";
require_once "models/UsuarioModel.php";
require_once "models/Material_CentroAcopioModel.php";
require_once "models/CanjeoMaterialModel.php";
require_once "models/TipoUsuarioModel.php";
require_once "models/DetalleCanjeoMaterialesModel.php";


/***--- Agregar todos los controladores*/
require_once "controllers/MaterialController.php";
require_once "controllers/CentroAcopioController.php";
require_once "controllers/ProvinciaController.php";
require_once "controllers/CantonController.php";
require_once "controllers/DistritoController.php";
require_once "controllers/UsuarioController.php";
require_once "controllers/Material_CentroAcopioController.php";
require_once "controllers/CanjeoMaterialController.php";
require_once "controllers/TipoUsuarioController.php";
require_once "controllers/DetalleCanjeoMaterialesController.php";

//Enrutador


//RoutesController.php
require_once "controllers/RoutesController.php";
$index = new RoutesController();
$index->index();