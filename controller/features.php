<?php

include '../model/features.model.php';

//$idClient = $_POST['idClient'];
$action = $_POST['action'];

switch($action) {

    case 'addFeature':

        $featureName = $_POST['featureName'];
        $value = $_POST['value'];
        $idProduct = $_POST['idProduct'];

        if(strlen($featureName) > 0 && strlen($value) > 0 && strlen($idProduct) > 0) {
        
            $addFeature = new modelFeatures();

            $data = $addFeature -> mdlAddFeature($featureName,$value,$idProduct);

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

    case 'updateFeature':

        $featureName = $_POST['featureName'];
        $value = $_POST['value'];
        $idFeature = $_POST['idFeature'];

        if(strlen($featureName) > 0 && strlen($value) > 0 && strlen($idFeature) > 0) {
        
            $updateFeature = new modelFeatures();

            $data = $updateFeature -> mdlUpdateFeature($featureName,$value,$idFeature);

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

    case 'deleteFeature':

        $idFeature = $_POST['idFeature'];

        if(strlen($idFeature) > 0) {

            $deteleFeature = new modelFeatures();

            $data = $deteleFeature -> mdlDeleteFeature($idFeature);

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

    case 'allFeatures':

        $allFeatures = new modelFeatures();

        $data = $allFeatures -> mdlGeneralInfoFeature();

        if(!$data) {

            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                
            echo json_encode($response, JSON_UNESCAPED_UNICODE);

        } else {

            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

        }

    break;

    case 'infoFeature':

        $idFeature = $_POST['idFeature'];

        if(strlen($idFeature) > 0) {
        
            $infoFeature = new modelFeatures();

            $data = $infoFeature -> mdlInfoFeature($idFeature);

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

?>