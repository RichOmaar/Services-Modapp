<?php
include '../model/user.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    
    if (isset($_POST['idUser']) && isset($_POST['state']) && isset($_POST['municipio']) && isset($_POST['street']) && isset($_POST['number_st']) && isset($_POST['number_int']) && isset($_POST['cp']) && isset($_POST['action'])) {

        $idUser = $_POST['idUser'];
        $action = $_POST['action'];

        switch('action'){

            case 'addAddress':

                $state = $_POST['state'];
                $municipio = $_POST['municipio'];
                $street = $_POST['street'];
                $number_st = $_POST['number_st'];
                $number_int = $_POST['number_int'];
                $cp = $_POST['cp'];

                if(strlen($idUser) > 0 && strlen($state) > 0 && strlen($municipio) > 0 && strlen($street) > 0 && strlen($number_st) > 0 && strlen($cp) > 0){

                    $addAddress = new modelUser();
        
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

                    $user = new modelUser();
                
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

            break;

            case 'deleteAddress':

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