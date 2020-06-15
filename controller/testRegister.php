<?php

include '../model/login.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {

    if (isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['mail']) && isset($_POST['password'])) {

        /*
        $fullname = 'Juan Omar Camacho';
        $username = 'richOmaar';
        $mail = 'juanomcam@gmail.com';
        $password = 'Juanomar123';
        */
        
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        

        if(strlen($fullname) > 0 && strlen($username) > 0 && strlen($mail) > 0 && strlen($password) > 0){
        
            $register = new modelLogin();

            $data = $register -> mdlRegisterUser($fullname, $username, $mail, $password);

            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

        } else {  

            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));

            echo json_encode($response, JSON_UNESCAPED_UNICODE); 
        }
    } else {
        
        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_POST_RESPONSE));

        echo json_encode($response, JSON_UNESCAPED_UNICODE); 
    }
}
?>