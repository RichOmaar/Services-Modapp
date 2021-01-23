<?php

include '../model/mail.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {

    if (isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['repeat'])) {

        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $repeat = $_POST['repeat'];

        //$mail = 'mail@gmail.com';
        //$password = 'Juanomar';
        //$repeat = 'Juanomar';

        if(strlen($mail) > 0 && strlen($password) > 0 && strlen($repeat) > 0){

            if($password == $repeat){
        
                $update = new modelMail();
        
                $data = $update -> mdlUpdatePasswordClient($mail,$password);
        
                if($data === false){
        
                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE)); 
        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
        
                } else {
        
                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => 'Your password has been updated'));
                    
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                    
                } 
        
            } else {
                
                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));
            
                echo json_encode($response, JSON_UNESCAPED_UNICODE); 
            }
        } else {
                
            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));
        
            echo json_encode($response, JSON_UNESCAPED_UNICODE); 
        }

    } else {
        
        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_POST_RESPONSE));

        echo json_encode($response, JSON_UNESCAPED_UNICODE); 
    }
}
?>