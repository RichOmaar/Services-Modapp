<?php

if ($_SERVER["REQUEST_METHOD"]=="POST") {

    if (isset($_POST['idClient']) && isset($_POST['action'])) {
        
        include '../model/dataClient.model.php';

        $idClient = $_POST['idClient'];
        $action = $_POST['action'];

        switch($action){

            case 'updateDataContact':

                $name_contact = $_POST['name_contact'];
                $tel = $_POST['tel'];

                if(strlen($idClient) > 0 && strlen($name_contact) > 0 && strlen($tel) > 0){

                    echo json_encode($idClient);
                    echo json_encode($name_contact);
                    echo json_encode($tel);

                    $update = new modelDataClient();

                    $data = $update -> mdlUpdateContactData($name_contact, $tel, $idClient);

                    if($data == false){

                        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));
                        
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

            case 'infoContactData':

                $info = new modelDataClient();

                $data = $info -> mdlInfoContactData($idClient);

                echo json_encode($data);

                if($data == false) {

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));
                        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE); 

                } else {
                
                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));
            
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                }

            break;
        }

    } else {
        
        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_POST_RESPONSE));

        echo json_encode($response, JSON_UNESCAPED_UNICODE); 
    }
}
?>