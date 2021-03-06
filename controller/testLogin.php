<?php

include '../model/login.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    
    if (isset($_POST['login']) && isset($_POST['passLogin'])) {

        /*
        $login = 'juanomcam@gmail.com';
        $passLogin = 'Juanomar123';
        */
        
        $login = $_POST['login'];
        $passLogin = $_POST['passLogin'];

        if(strlen($login) > 0 && strlen($passLogin) > 0){
            
            $start = new modelLogin();

            $data = $start -> mdlLogin($login, $passLogin);

            if($data === false){

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));

                echo json_encode($response, JSON_UNESCAPED_UNICODE); 
                
            } else{

                $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            }

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