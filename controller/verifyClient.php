<?php

include '../model/loginClient.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {

    if (isset($_POST['login'])) {
        
        $login = 'mail@gmail.comm';
        
        if(strlen($login) > 0){

            $verify = new modelLoginClient();

            $data = $verify -> mdlVerifyClient($login);

            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

        } else {

            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_NO_USER_FOUND));

            echo json_encode($response, JSON_UNESCAPED_UNICODE); 

        }

    } else {
        
        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_POST_RESPONSE));

        echo json_encode($response, JSON_UNESCAPED_UNICODE); 
    }
}
?>