<?php

include '../model/login.model.php';

/*
$login = $_POST['login'];
*/

$login = 'richOmaar';

if(strlen($login) > 0){

    $verify = new modelLogin();

    $data = $verify -> mdlVerifyUser($login);

    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} else {

    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_NO_USER_FOUND));

    echo json_encode($response, JSON_UNESCAPED_UNICODE); 

}
?>