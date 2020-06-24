<?php
include '../model/user.model.php';

$idUser = 1;

if(strlen($idUser) > 0){

    $user = new modelUser();
                
    $data = $user -> mdlInfoAddress($idUser);

    $idAddres = $data[0]['id_address'];

    if($data == false){

        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_NO_USER_FOUND));

        echo json_encode($response, JSON_UNESCAPED_UNICODE); 

    } else {

        $delete = $user -> mdlDeleteAddress($idAddres);

        if($delete == false) {
                
            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));
    
            echo json_encode($response, JSON_UNESCAPED_UNICODE); 

        } else {
    
            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));
    
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            
        }
        
    }

} else {  

    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));

    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
}
?>