<?php

include '../model/store.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {


    if (  ! (isset($_POST["idClient"]) && isset($_POST["action"])) ) {
        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }

    
    $idClient = $_POST['idClient'];
    $action = $_POST['action'];

    switch($action) {

        case 'addStore':

            $store_name = $_POST['store_name'];
            $image = $_POST['image'];
            $maps = $_POST['maps'];

            if(strlen(trim($store_name)) > 0 && strlen(trim($maps)) > 0) {

                $addStore = new modelStore();

                if($image == '') {

                    $image = NULL;
                    
                }

                $data = $addStore -> mdlAddStore($store_name, $image, $maps, $idClient);

                if($data == false) {

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
                } else {
    
                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => 'Tienda agregada correctamente'));
    
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
                }
            
            } else {  
        
                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
    
                echo json_encode($response, JSON_UNESCAPED_UNICODE); 
            }
        break;

        case 'updateStore':

            $store_name = $_POST['store_name'];
            $image = $_POST['image'];
            $maps = $_POST['maps'];
            $idStore = $_POST['idStore'];

            if(strlen(trim($idStore)) > 0 && strlen(trim($store_name)) > 0 && strlen(trim($maps)) > 0) {

                $updateStore = new modelStore();

                if($image == '') {

                    $image = NULL;
                    
                }

                $data = $updateStore -> mdlUpdateStore($idStore, $store_name, $image, $maps);

                if(!$data) {

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
                } else {
    
                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => 'Tienda actualizada correctamente'));
    
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
                }
            
            } else {  
        
                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
    
                echo json_encode($response, JSON_UNESCAPED_UNICODE); 
            }

        break;

        case 'deleteStore':

            $idStore = $_POST['idStore'];

            if(strlen(trim($idStore)) > 0) {

                $deleteStore = new modelStore();

                $delete = $deleteStore -> mdlDeleteStore($idStore);

                if(!$delete) {

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                    
                } else {

                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => 'Tienda eliminada correctamente'));
        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                }

            } else {  
        
                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
    
                echo json_encode($response, JSON_UNESCAPED_UNICODE); 
            }

        break;

        case 'infoStore':

            $infoStore = new modelStore();

            $info = $infoStore -> mdlInfoStore($idClient);

            if($info == false) {

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                        
                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            } else {

                $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $info));
    
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            }

        break;

        default:

            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));
            
            echo json_encode($response, JSON_UNESCAPED_UNICODE); 

    }

    
}

?>