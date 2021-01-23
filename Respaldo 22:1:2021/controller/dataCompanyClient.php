<?php
 
if ($_SERVER["REQUEST_METHOD"]=="POST") {

    if (isset($_POST['idClient']) && isset($_POST['action'])) {

        include '../model/dataClient.model.php';

        $idClient = $_POST['idClient'];
        $action = $_POST['action'];

        switch($action){

            case 'updateDataContact':

                $image = $_POST['image'];
                $companyName = $_POST['companyName'];
                $companyMail = $_POST['companyMail'];
                $companyTel = $_POST['companyTel'];
                $rfc = $_POST['rfc'];
                $description = $_POST['description'];

                if(strlen($idClient) > 0 && strlen($image) > 0 && strlen($companyName) > 0 && strlen($companyMail) > 0 && strlen($companyTel) > 0 && strlen($rfc) > 0 && strlen($description) > 0){

                    $update = new modelDataClient();

                    $data = $update -> mdlUpdateCompanyData($image, $companyName, $companyMail, $companyTel, $rfc, $description, $idClient);

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

            case 'infoCompanyData':

                $info = new modelDataClient();

                $data = $info -> mdlInfoCompanyData($idClient);

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