<?php

include '../model/measurements.model.php';

$idRange = 5;
$idPartClothing = 1;
$idSize = 1;

$add = new modelMeasurement();

$data = $add -> mdlAddMeasurement($idRange, $idPartClothing, $idSize);

$array = array();

$array['idColor'] = 1;
$array['hex'] = '000000';
$array['nombre'] = 'negro';



echo json_encode($array);
$prueba = json_encode($array);

?>
