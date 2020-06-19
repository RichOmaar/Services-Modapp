<?php
include '../model/mail.model.php';

$mail = $_POST['mail'];
$password = $_POST['password'];
$repeat = $_POST['repeat'];

if(strlen($mail) > 0 && strlen($password) > 0 && strlen($repeat) > 0){

    if($password == $repeat){

        $update = new modelMail();

        $data = $update -> mdlUpdatePassword($mail,$password);

        if($data = true){
            $response = new Response(array('status' => Constants::OK_RESPONSE, 'Your password has been updated'));
            
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        } else {
            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));

            echo json_encode($response, JSON_UNESCAPED_UNICODE); 
        } 
    }
} else {
        
    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));

    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
}

?>