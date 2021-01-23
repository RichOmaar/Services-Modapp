<?php

include '../model/gender.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {

    //$idClient = $_POST['idClient'];
    $action = $_POST['action'];

    switch($action) {

        case 'infoGender':

            $idGenderName = $_POST['idGenderName'];

            $infoGender = new modelGender();

            $data = $infoGender -> mdlInfoGender($idGenderName);

            if(!$data) {

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                    
                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            } else {

                $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            }

        break;

        case 'generalInfoGender':

            $infoGender = new modelGender();

            $data = $infoGender -> mdlGeneralInfoGender();

            if(!$data) {

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                    
                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            } else {

                $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            }

        break;

        default:
        
            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));
            
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

}
?>