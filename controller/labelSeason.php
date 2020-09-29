<?php

include '../model/labelSeason.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {

    //$idClient = $_POST['idClient'];
    $action = $_POST['action'];

    switch($action) {

        case 'addLabelSeason':

            $seasonName = $_POST['seasonName'];

            if(strlen($seasonName) > 0) {

                $addSeason = new modelLabelSeason();

                $data = $addSeason -> mdlAddLabelSeason($seasonName);

                if(!$data) {

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

        case 'deleteLabelSeason':

            $idLabelSeason = $_POST['idLabelSeason'];

            if(strlen($idLabelSeason) > 0) {

                $deleteSeason = new modelLabelSeason();

                $data = $deleteSeason -> mdlDeleteLabelSeason($idLabelSeason);

                if(!$data) {

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

        case 'showAllSeasons':

            $showSeason = new modelLabelSeason();

            $data = $showSeason -> mdlGeneralInfoLabelSeason();

            if(!$data) {

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                    
                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            } else {

                $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            }

        break;

        case 'showSeason':

            $idLabelSeason = $_POST['idLabelSeason'];

            if(strlen($idLabelSeason) > 0) {

                $showSeason = new modelLabelSeason();

                $data = $showSeason -> mdlInfoLabelSeason($idLabelSeason);

                if(!$data) {

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

        default:
        
            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));
                
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
}

?>