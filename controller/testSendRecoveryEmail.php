<?php
include '../model/mail.model.php';


if ( $_SERVER["REQUEST_METHOD"] != "POST") {
    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_POST_RESPONSE));
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die(); 
}


if(! isset($_POST["mail"]) ){
    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));
    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
    die();
}

$mail = $_POST['mail'];

if(strlen($mail) == 0){
    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));
    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
    die();
}

$checkEmail = new modelMail();
$data = $checkEmail -> mdlCheckMail($mail);

if($data != false){
    $sendMail = new modelMail();
    $subject = 'Modapp - Recovery password';
    $message = 'http://modapp.longbit.mx/view/passwordRecovery.php?mail=' . $mail.' If you did not request the change, then ignore this message.';

    try{
        $response = $sendMail -> mdlSendEmail($mail,$subject,$message);
        $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => '¡Revisa tu bandeja de entrada o carpeta de no deseados para actualizar tu contraseña!'));
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    } catch(PDOException $e){
        echo $e -> getMessage();
        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
    }

} 
else {  
    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
}


?>