<?php

$array = array();

$array[0]['url'] = 'www.prueba.com';
$array[0]['order'] = '1';
$array[1]['url'] = 'www.prueba2.com';
$array[1]['order'] = '2';
$array[2]['url'] = 'www.prueba3.com';
$array[2]['order'] = '3';

print_r($array);
echo json_encode($array);

?>