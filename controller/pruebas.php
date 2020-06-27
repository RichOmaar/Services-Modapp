<?php
include '../model/address.model.php';
include '../model/user.model.php';

$idUser = 2;

$state = ['state'];
$municipio = ['municipio'];
$street = ['street'];
$number_st = ['number_st'];
$number_int = ['number_int'];
$cp = ['cp'];
                
if(strlen($state) > 0 && strlen($municipio) > 0 && strlen($street) > 0 && strlen($number_st) > 0 && strlen($cp) > 0){

    $user = new modelAddress();

    $data = $user -> mdlInfoAddress($idUser);
                
    if($data != false){

        $update = new modelAddress();

        $addres = $update -> mdlUpdateAddress($idUser,$state,$municipio,$street,$number_st,$number_int,$cp);

        if($addres != false){
                

            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $addres));
    
            echo json_encode($response, JSON_UNESCAPED_UNICODE);

        } else {
    
            //$response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_NO_USER_FOUND));

            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'Estamos aqui'));

            echo json_encode($response, JSON_UNESCAPED_UNICODE); 

        }

    } else {

        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_NO_USER_FOUND));

        echo json_encode($response, JSON_UNESCAPED_UNICODE);

    }

} else {  
    
    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));

    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
}
        
?>