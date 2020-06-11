<?php
require '../model/login.model.php';
require '../model/connection.php';

$fullname = 'Juan Omar Camacho';
$username = 'richOmaar';
$mail = 'juanomcam@gmail.com';
$password = 'Juanomar123';

$register = modelLogin::mdlRegisterUser($fullname, $username, $mail, $password);

if(!$register){
    echo '{"response":"error"}';
} else {
    echo '{"response":"success"}';
}
/*
if(strlen($fullname) > 0 && strlen($username) > 0 && strlen($mail) > 0 && strlen($password) > 0){
   
    $register = new modelLogin();

    $data = $register -> mdlRegisterUser($fullname, $username, $mail, $password);

    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

    print_r($data);

} else {  

    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));

    print_r($response);

    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
}

*/



?>