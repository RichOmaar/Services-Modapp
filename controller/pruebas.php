<?php
include '../model/user.model.php';

$idUser = 1;

if(strlen($idUser) > 0){

    $user = new modelUser();

    $data = $user -> mdlInfoAddress($idUser);

    //echo json_encode($data);
                
    if($data == false){

        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_NO_USER_FOUND));

        echo json_encode($response, JSON_UNESCAPED_UNICODE); 

    } else {

        //No estoy seguro si un input vacío se envía desde el front como '' o NULL 
        $state = 'Mexico';
        $municipio = 'neza';
        $street = 'Mexico';
        $number_st = 'Neza';
        $number_int = 'Mexico';
        $cp ='Neza';

        $update = new Connection();
/*
        if($state == ''){

            echo $state = $data[0]['state'];

        } 
        
        if($municipio == '' ) {

            echo $municipio = $data[0]['municipio'];

        } 
        
        if($street == '') {

            echo $street = $data[0]['street'];

        } 
        
        if($number_st == ''){

            echo $number_st = $data[0]['number_st'];

        } 
        
        if($number_int == ''){

            echo $number_int = $data[0]['number_int'];

        } 
        
        if($cp == ''){

            echo $cp = $data[0]['cp'];

        }
    */

        $update = $user -> mdlUpdateAddress($idUser,$state,$municipio,$street,$number_st,$number_int,$cp);

        echo json_encode ($update);

        if($update === false){
                
            //$response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_NO_USER_FOUND));
            
            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'Estamos aqui'));
    
            echo json_encode($response, JSON_UNESCAPED_UNICODE); 

        } else {
    
            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $update));
    
            echo json_encode($response, JSON_UNESCAPED_UNICODE);

        }

    }

} else {  
    
    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));

    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
}

?>