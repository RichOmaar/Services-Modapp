<?php

include '../model/address.model.php';
include '../model/user.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    
    if (isset($_POST['idUser']) && isset($_POST['action'])) {

        $idUser = $_POST['idUser'];
        $action = $_POST['action'];

        switch($action){

            case 'addAddressUser':

                $state = $_POST['state'];
                $municipio = $_POST['municipio'];
                $street = $_POST['street'];
                $number_st = $_POST['number_st'];
                $number_int = $_POST['number_int'];
                $cp = $_POST['cp'];

                if(strlen($idUser) > 0 && strlen($state) > 0 && strlen($municipio) > 0 && strlen($street) > 0 && strlen($number_st) > 0 && strlen($cp) > 0){

                    $addAddress = new modelAddress();
        
                    if($number_int == ''){
        
                        $number_int = NULL;
                    }
        
                    $data = $addAddress -> mdlAddAddressUser($idUser,$state,$municipio,$street,$number_st,$number_int,$cp);
        
                    if($data === false){
        
                        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                        
                        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        
                    } else {
        
                        $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));
        
                        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        
                    }
        
                } else {  
        
                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
                }

            break;

            case 'infoAddressUser':

                if(strlen($idUser) > 0){

                    $user = new modelAddress();
                
                    $data = $user -> mdlInfoAddressUser($idUser);
                
                    //$idAddres['idAddress'] = $data[0]['id_address'];
                
                    if($data == false){
                
                        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_NO_USER_FOUND));
                
                        echo json_encode($response, JSON_UNESCAPED_UNICODE); 

                    } else {
                
                        $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));
                
                        echo json_encode($response, JSON_UNESCAPED_UNICODE);

                    }
                
                } else {  
                
                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                
                    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
                }

            break;

            case 'updateAddressUser':

                $state = $_POST['state'];
                $municipio = $_POST['municipio'];
                $street = $_POST['street'];
                $number_st = $_POST['number_st'];
                $number_int = $_POST['number_int'];
                $cp = $_POST['cp'];
                $idAddress = $_POST['idAddress'];
                                
                if(strlen($state) > 0 && strlen($municipio) > 0 && strlen($street) > 0 && strlen($number_st) > 0 && strlen($cp) > 0){
        
                    $user = new modelAddress();
        
                    $data = $user -> mdlInfoAddressUser($idUser);
                                
                    if($data != false){
        
                        $update = new modelAddress();
        
                        $addres = $update -> mdlUpdateAddress($idAddress,$state,$municipio,$street,$number_st,$number_int,$cp);
        
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

            break;

            case 'deleteAddressUser':

                $idAddres = $_POST['idAddress'];

                if(strlen($idAddres) > 0){

                        $addres = new modelAddress();

                        $delete = $addres -> mdlDeleteAddress($idAddres);

                        if($delete != false){
                                
        
                            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $delete));
                    
                            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        
                        } else {
                    
                            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_NO_USER_FOUND));
        
                            //$response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'Estamos aqui'));
        
                            echo json_encode($response, JSON_UNESCAPED_UNICODE); 
        
                        }
                } else {

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_NO_USER_FOUND));

                    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
                }
                
            break;

            default:

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_POST_RESPONSE));
                
                echo json_encode($response, JSON_UNESCAPED_UNICODE); 

        }

    } else {
        
        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_POST_RESPONSE));

        echo json_encode($response, JSON_UNESCAPED_UNICODE); 
    }
}
?>