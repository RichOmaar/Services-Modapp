<?php

include '../model/mail.model.php';
include '../model/route.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {

    if (isset($_POST['mail'])) {

        $mail = $_POST['mail'];
        
        $route = new ruta();

        $url = $route -> obtenerRuta();
        //$mail = 'mail@gmail.com';

        if(strlen($mail) > 0){

        $checkEmail = new modelMail();

        $data = $checkEmail -> mdlCheckMailClient($mail);

            if($data[0]['mail'] == $mail){

                $sendMail = new modelMail();

                $subject = 'Modapp - Recovery password';

                //$message = $url.'view/passwordRecovery.php?mail='.$mail.' If you did not request the change, then ignore this message.';

                $message = 'http://localhost:8888/GitHub/Services-Modapp/view/passwordRecovery.php?mail='.$mail.' If you did not request the change, then ignore this message.';

                try{

                $response = modelMail::mdlSendEmail($mail,$subject,$message);
                
                //$response = $sendMail -> mdlSendEmail($mail,$subject,$message);

                echo ($response);
                
                $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => '¡Revisa tu bandeja de entrada o carpeta de no deseados para actualizar tu contraseña!'));

                echo json_encode($response, JSON_UNESCAPED_UNICODE);

                } catch(PDOException $e){

                    echo $e -> getMessage();

                }

            } else {
                
                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'Primer if'));

                echo json_encode($response, JSON_UNESCAPED_UNICODE); 
            }

        } else {
            
        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));

        echo json_encode($response, JSON_UNESCAPED_UNICODE); 
        }

    } else {
        
        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_POST_RESPONSE));

        echo json_encode($response, JSON_UNESCAPED_UNICODE); 
    }
}
?>