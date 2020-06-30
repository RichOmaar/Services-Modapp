<?php

include '../model/loginClient.model.php';

//$company_name = $_POST['company_name'];
//$mail = $_POST['mail'];
//$name_contact = $_POST['name_contact'];
//$password = $_POST['password'];

$company_name = 'omar';
$mail = 'mail@gmail.comm';
$name_contact = 'name_contact';
$password ='password';

if(strlen($company_name) > 0 && strlen($mail) > 0 && strlen($name_contact) > 0 && strlen($password) > 0){

    $verifyUser = new modelLoginClient();

    $checkUsername = $verifyUser -> mdlVerifyClient($company_name);

    echo json_encode ($checkUsername);

    if($check != false){

        echo json_encode($checkUsername);

        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'The user already exist'));

        echo json_encode($response, JSON_UNESCAPED_UNICODE);

    } else {

        $checkEmail = $verifyUser -> mdlVerifyClient($mail);

        if($checkEmail === false){
            
            echo 'entro aqui';

            $register = new modelLoginClient();

            $data = $register -> mdlRegisterClient($company_name, $mail, $name_contact, $password);

            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

        } else {  

        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'The email already exist'));

        echo json_encode($response, JSON_UNESCAPED_UNICODE); 
        }
        
        
    }
    
} else {

    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'The user or password already exist'));

    echo json_encode($response, JSON_UNESCAPED_UNICODE); 

}


?>