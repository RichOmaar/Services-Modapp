<?php

include '../model/login.model.php';

$login = 'juanomcam@gmail.com';

/*
$login = $_POST['login'];
*/

if(strlen($login) > 0){

    $register = new modelLogin();

    $data = $register -> mdlGetUserInfo($login);

    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
} else {  

    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));

    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
}

?>


