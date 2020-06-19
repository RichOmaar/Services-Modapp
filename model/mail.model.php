<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once '../vendor/autoload.php';
require_once 'route.model.php';
require_once 'connection.php';

class modelMail {

    public function mdlCheckMail($mail) {
        
        $db = new Connection();
        
        $connection = $db -> get_connection();

        $sql = "SELECT mail FROM user WHERE mail = :mail";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':mail',$mail);

        $statement -> execute();

        return ($statement -> rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;

    }

    public function mdlUpdatePassword($mail,$password){

        $db = new Connection();

        $connection = $db -> get_connection();

        $hash = password_hash($password,PASSWORD_BCRYPT);

        $sql = "UPDATE user SET user.password = :password WHERE mail = :mail";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':password',$hash);

        $statement -> bindParam(':mail',$mail);

        $statement -> execute();

        return ($statement -> rowCount() > 0) ? true : false;

    }
/*
    public function mdlSendEmail($correo,$subject,$message) {

        $send = new PHPMailer;

        $send->isSendMail();

        $mail->SMTPDebug = 2;
        $mail->Host = 'mail.legendarykicks.mx';
        $mail->Port = '587';
        $mail->SMTPAuth = true;
        $mail->Userame = 'omar@legendarykicks.mx';
        $mail->Password = 'Juandedios123';
        $mail->setFrom('omar@legendarykicks.mx', 'Modapp');

        $mail->addAddress($correo,'Modapp');
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Encoding = 'base64';

        $mail->msgHTML($message);
        $mail->AltBody = $message;

        if(!$mail->send()){
            return '{"error":"error"}';
        } else {
            return '{"success":"success"}';
        }
    }

    */
    public static function mdlSendEmail($correo,$subject,$message){

        //aquí va el html
        $mail = new PHPMailer;

        $mail->isSendMail();
        //$mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Host = 'mail.legendarykicks.mx';
        $mail->Port = '587';
        $mail->SMTPAuth = true;
        $mail->Userame = 'omar@legendarykicks.mx';
        $mail->Password = 'Juandedios123';
        $mail->setFrom('omar@legendarykicks.mx', 'Cursodontic');

        $mail->addAddress($correo,'Cursodontic');
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Encoding = 'base64';

        $mail->msgHTML($message);
        $mail->AltBody = $message;

        if(!$mail->send()){
            return '{"error":"error"}';
        } else {
            return '{"success":"success"}';
        }
    }

}
?>