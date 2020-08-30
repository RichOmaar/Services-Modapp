<?php

include '../model/scheduleStore.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    
    $idStore = $_POST['idStore'];
    $action = $_POST['action'];

    switch($action){

        case 'infoSchedule':

            $schedule = new modelScheduleStore();

            $data = $schedule -> mdlInfoSchedule($idStore);

            echo json_encode($data);

            if($data == false) {

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));
                    
                echo json_encode($response, JSON_UNESCAPED_UNICODE); 

            } else {
            
                $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));
        
                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            }

        break;

        case 'addFirstSchedule':

            $check = new modelScheduleStore();

            $data = $check -> mdlCountScheduleAdded($idStore);

            if($data[0]['COUNT(*)'] >= 7){

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'Ya has agregado los 7 días de la semana'));
                    
                echo json_encode($response, JSON_UNESCAPED_UNICODE); 

            } else {

                $openL = $_POST['openL'];
                $closeL = $_POST['closeL'];
                $openM = $_POST['openM'];
                $closeM = $_POST['closeM'];
                $openW = $_POST['openW'];
                $closeW = $_POST['closeW'];
                $openJ = $_POST['openJ'];
                $closeJ = $_POST['closeJ'];
                $openV = $_POST['openV'];
                $closeV = $_POST['closeV'];
                $openS = $_POST['openS'];
                $closeS = $_POST['closeS'];
                $openD = $_POST['openD'];
                $closeD = $_POST['closeD'];

                // $openL = !empty($openL) ? "'$openL'" : "NULL";
                // $openL = !empty($openL) ? "'$openL'" : "NULL";

                if(strlen($openL) == 0){
    
                    $openL = NULL;
                    $closeL = NULL;

                }

                if(strlen($openM) == 0){
    
                    $openM = NULL;
                    $closeM = NULL;

                }

                if(strlen($openW) == 0){
    
                    $openW = NULL;
                    $closeW = NULL;

                }

                if(strlen($openJ) == 0){
    
                    $openJ = NULL;
                    $closeJ = NULL;

                }

                if(strlen($openV) == 0){
    
                    $openV = NULL;
                    $closeV = NULL;

                }

                if(strlen($openS) == 0){
    
                    $openS = NULL;
                    $closeS = NULL;

                }

                if(strlen($openD) == 0){
    
                    $openD = NULL;
                    $closeD = NULL;

                } 
                
                $data2 = $check -> mdlAddFirstSchedule($idStore, $openL, $closeL, $openM, $closeM, $openW, $closeW, $openJ, $closeJ, $openV, $closeV, $openS, $closeS, $openD, $closeD);

                if($data2 == false) {

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));
                        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE); 

                } else {
                
                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data2));
            
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                }

            }

        break;

        case 'addMoreSchedule':

            $openL = $_POST['openL'];
            $closeL = $_POST['closeL'];
            $openM = $_POST['openM'];
            $closeM = $_POST['closeM'];
            $openW = $_POST['openW'];
            $closeW = $_POST['closeW'];
            $openJ = $_POST['openJ'];
            $closeJ = $_POST['closeJ'];
            $openV = $_POST['openV'];
            $closeV = $_POST['closeV'];
            $openS = $_POST['openS'];
            $closeS = $_POST['closeS'];
            $openD = $_POST['openD'];
            $closeD = $_POST['closeD'];

            if(strlen($openL) == 0){
    
                $openL = NULL;
                $closeL = NULL;

            }

            if(strlen($openM) == 0){

                $openM = NULL;
                $closeM = NULL;

            }

            if(strlen($openW) == 0){

                $openW = NULL;
                $closeW = NULL;

            }

            if(strlen($openJ) == 0){

                $openJ = NULL;
                $closeJ = NULL;

            }

            if(strlen($openV) == 0){

                $openV = NULL;
                $closeV = NULL;

            }

            if(strlen($openS) == 0){

                $openS = NULL;
                $closeS = NULL;

            }

            if(strlen($openD) == 0){

                $openD = NULL;
                $closeD = NULL;

            } 

            $update = new modelScheduleStore();
            
            $data = $update -> mdlAddMoreSchedule($idStore, $openL, $closeL, $openM, $closeM, $openW, $closeW, $openJ, $closeJ, $openV, $closeV, $openS, $closeS, $openD, $closeD);

                if($data == false) {

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));
                        
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