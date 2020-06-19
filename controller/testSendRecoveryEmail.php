<?php
include '../model/mail.model.php';

//$mail = $_POST['mail'];

$mail = 'pepe@gmail.com';

if(strlen($mail) > 0){
    
    $checkEmail = new modelMail();

    $data = $checkEmail -> mdlCheckMail($mail);

    if($data[0]['mail'] == $mail){

        $sendMail = new modelMail();

        $subject = 'Modapp - Recovery password';


        $message = 'http://localhost:8888/GitHub/Services-Modapp/view/passwordRecovery.php?mail='.$mail.' If you did not request the change, then ignore this message.';

        echo ($subject);
        echo ($mail);
        echo ($message);

        $sendMail -> mdlSendEmail($mail,$subject,$message);

        $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => '¡Revisa tu bandeja de entrada o carpeta de no deseados para actualizar tu contraseña!'));

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        
    } else {
        
        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'Primer if'));
    
        echo json_encode($response, JSON_UNESCAPED_UNICODE); 
    }
} else {
        
    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));

    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
}



?>