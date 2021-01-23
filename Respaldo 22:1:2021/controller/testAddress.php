<?php

include '../model/address.model.php';
include '../model/user.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    
    if (isset($_POST['idUser']) && isset($_POST['action'])) {

        $idUser = $_POST['idUser'];
        $action = $_POST['action'];

        switch($action){

            case 'addAddress':

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
        
                    $data = $addAddress -> mdlAddAddress($idUser,$state,$municipio,$street,$number_st,$number_int,$cp);
        
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

            case 'infoAddress':

                if(strlen($idUser) > 0){

                    $user = new modelAddress();
                
                    $data = $user -> mdlInfoAddress($idUser);
                
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

            case 'updateAddress':

                $state = $_POST['state'];
                $municipio = $_POST['municipio'];
                $street = $_POST['street'];
                $number_st = $_POST['number_st'];
                $number_int = $_POST['number_int'];
                $cp = $_POST['cp'];
                                
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

            break;

            case 'deleteAddress':

                if(strlen($idUser) > 0){

                    $user = new modelUser();
                                
                    $data = $user -> mdlInfoUser($idUser);

                    $idAddres = $data[0]['id_address'];

                    if($data != false){

                        $addres = new modelAddress();

                        $deleteAddressTableUser = $addres -> mdlDeleteAddressUser($idUser);

                        if($deleteAddressTableUser != false){

                            $deleAddress = $addres -> mdlDeleteAddress($idAddres);

                            if($deleAddress != false){

                                $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => Constants::OK_RESPONSE_QUERY));
                    
                                echo json_encode($response, JSON_UNESCAPED_UNICODE);

                            } else {

                                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_QUERY));

                                //$response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'No se hizo el segundo query'));
                    
                                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                            }

                        } else {

                            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_QUERY));
                    
                            //$response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'No se hizo la primer consulta'));

                            echo json_encode($response, JSON_UNESCAPED_UNICODE);
                        }

                    } else {

                        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_NO_USER_FOUND));

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