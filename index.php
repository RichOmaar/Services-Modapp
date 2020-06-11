<?php

date_default_timezone_set('UTC');
date_default_timezone_set("America/Mexico_City");

require_once "controlador/plantilla.controlador.php";

require_once "modelo/conexion.php";

$plantilla = new controladorPlantilla();

$plantilla -> obtenerPlantilla();

?>