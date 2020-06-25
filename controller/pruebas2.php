<?php

include '../model/login.model.php';


$fullname = 'Juan Omar Camacho';
$username = 'Omaar';
$mail = 'juan@gmail.com';
$password = 'Juanomar123';

/*
$fullname = $_POST['fullname'];
$username = $_POST['username'];
$mail = $_POST['mail'];
$password = $_POST['password'];
*/

if(strlen($fullname) > 0 && strlen($username) > 0 && strlen($mail) > 0 && strlen($password) > 0){

    $verifyUser = new modelLogin();

    $checkUsername = $verifyUser -> mdlVerifyUser($username);

    echo json_encode ($checkUsername);

    if($check != false){

        echo json_encode($checkUsername);

        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'The user already exist'));

        echo json_encode($response, JSON_UNESCAPED_UNICODE);

    } else {

        $checkEmail = $verifyUser -> mdlVerifyUser($mail);

        if($checkEmail === false){
            
            echo 'entro aqui';

            $register = new modelLogin();

            $data = $register -> mdlRegisterUser($fullname, $username, $mail, $password);

            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

        } else {  

        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'The email already exist'));

        echo json_encode($response, JSON_UNESCAPED_UNICODE); 
        }
        
        
    }
    
} else {

    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'The user or password already exist 2'));

    echo json_encode($response, JSON_UNESCAPED_UNICODE); 

}

?>