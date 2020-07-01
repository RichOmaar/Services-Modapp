<?php

include '../model/login.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    
    if (isset($_POST['login']) && isset($_POST['passLogin'])) {

        /*
        $login = 'mail@gmail.com';
        $passLogin = 'Juanomarr';
        */
        
        $login = $_POST['login'];
        $passLogin = $_POST['passLogin'];
        

        if(strlen($login) > 0 && strlen($passLogin) > 0){
            
            $start = new modelLoginClient();

            $data = $start -> mdlLoginClient($login, $passLogin);

            if($data === false){

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'Error'));

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