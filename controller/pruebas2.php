<?php

include '../model/login.model.php';

$idUser = 1;

if(strlen($idUser) > 0){
    

} else {  
    
    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));

    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
}
?>