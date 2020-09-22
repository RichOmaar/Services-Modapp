<?php

include '../model/address.model.php';
include '../model/user.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    
    if (isset($_POST['idClient']) && isset($_POST['action'])) {

        $idClient = $_POST['idClient'];
        $action = $_POST['action'];

        switch($action){

            case 'addAddressClient':

                $state = $_POST['state'];
                $municipio = $_POST['municipio'];
                $street = $_POST['street'];
                $number_st = $_POST['number_st'];
                $number_int = $_POST['number_int'];
                $cp = $_POST['cp'];

                if(strlen($idClient) > 0 && strlen($state) > 0 && strlen($municipio) > 0 && strlen($street) > 0 && strlen($number_st) > 0 && strlen($cp) > 0){

                    $addAddress = new modelAddress();
        
                    if($number_int == ''){
        
                        $number_int = NULL;
                    }
        
                    $data = $addAddress -> mdlAddAddressClient($idClient,$state,$municipio,$street,$number_st,$number_int,$cp);
        
                    if($data === false){
        
                        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                        
                        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        
                    } else {
        
                        $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => 'Dirección agregada correctamente'));
        
                        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        
                    }
        
                } else {  
        
                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
                }

            break;

            case 'infoAddressClient':

                if(strlen($idClient) > 0){

                    $client = new modelAddress();
                
                    $data = $client -> mdlInfoAddressClient($idClient);
                
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

            case 'updateAddressClient':

                $state = $_POST['state'];
                $municipio = $_POST['municipio'];
                $street = $_POST['street'];
                $number_st = $_POST['number_st'];
                $number_int = $_POST['number_int'];
                $cp = $_POST['cp'];
                $idAddress = $_POST['idAddress'];
                                
                if(strlen($state) > 0 && strlen($municipio) > 0 && strlen($street) > 0 && strlen($number_st) > 0 && strlen($cp) > 0){

                    if($number_int == ''){
        
                        $number_int = NULL;
                    }
        
                    $update = new modelAddress();
        
                    $address = $update -> mdlUpdateAddress($idAddress,$state,$municipio,$street,$number_st,$number_int,$cp);
    
                    if(!$address){
                            
                        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_NO_USER_FOUND));
    
                        //$response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'Estamos aqui'));
    
                        echo json_encode($response, JSON_UNESCAPED_UNICODE); 
    
                    } else {

                        $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => 'Dirección actualizada correctamente'));
                
                        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
                    }
        
                } else {  
                    
                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
                }

            break;

            case 'deleteAddressClient':

                $idAddress = $_POST['idAddress'];

                if(strlen($idAddress) > 0){

                        $address = new modelAddress();

                        $delete = $address -> mdlDeleteAddress($idAddress);

                        if($delete != false){
                                
        
                            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => 'Dirección eliminada correctamente'));
                    
                            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        
                        } else {
                    
                            //$response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_NO_USER_FOUND));
        
                            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'Error al intentar eliminar dirección, intente nuevamente'));
        
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