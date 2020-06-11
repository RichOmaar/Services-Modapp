<?php

include '../model/login.model.php';

$login = 'juanomcam@gmail.com';
$passLogin = '$2y$10$s2hX8SY7/TQF3J3LyqDgdesCzyX3/lu5Uh/L9qBybsGZe8Sifel2m';

if(strlen($login) > 0 && strlen($passLogin) > 0){
    
    $start = new modelLogin();

    $data = $start -> mdlLogin($login, $passLogin);
    
    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

    } else {  

    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));

    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
}
?>