<?php
echo 'hola';
require_once 'connection.php';

$db = new Connection();

$connection = $db -> get_connection();
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * from address";


$statement = $connection -> prepare($sql);
$statement->execute();


echo ("debugging");




/*$store = $statement->fetchAll(PDO::FETCH_ASSOC)
var_dump($store);*/
