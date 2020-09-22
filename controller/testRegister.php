<?php

include '../model/login.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {

    if (isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['mail']) && isset($_POST['password'])) {

        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        

        if(strlen($fullname) > 0 && strlen($username) > 0 && strlen($mail) > 0 && strlen($password) > 0){

            $verifyUser = new modelLogin();
            $checkUsername = $verifyUser -> mdlVerifyUser($username);
    
            if($checkUsername != false){

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'El usuario ya existe'));

                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            } else {

                $checkEmail = $verifyUser -> mdlVerifyUser($mail);

                if($checkEmail === false){                

                    $register = new modelLogin();

                    $data = $register -> mdlRegisterUser($fullname, $username, $mail, $password);

                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => 'El usuario ha sido registrado exitosamente'));

                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                } else {  

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'El correo ya ha sido registrado '));

                echo json_encode($response, JSON_UNESCAPED_UNICODE); 
                }
                
                
            }
            
        } else {

            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'Falta información para ejecutar la petición'));

            echo json_encode($response, JSON_UNESCAPED_UNICODE); 

        }
    } else {
        
        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_POST_RESPONSE));

        echo json_encode($response, JSON_UNESCAPED_UNICODE); 
    }
}
?>