<?php

require_once 'connection.php';

class modelLogin {

    public function mdlLogin ($login,$passLogin){

        $mdlLogin = new modelLogin();

        //s$exist = false;

        $response = $mdlLogin -> mdlVerifyUser($login);

        if(!$response){

            return false;

        }else{

            $data = $mdlLogin -> mdlGetUserInfo($login);

            if(password_verify($passLogin,$data[0]['password'])){

                return $data;

            } else {

                return false;

            }
        }

        //return $exist;
    }

    public function mdlVerifyUser($login){

         $db = new Connection();

         $connection = $db -> get_connection();
         //1.- El string en donde voy a buscar
         //2.- El string que quiero bucar
         //3.- Desde la posición donde quiero buscar (entero)

         $at = strpos($login,'@',0);

         //False en caso de que no haya un @ dentro de la cadena
         //Retorna la posición en donde se encuentra el @

         if($at === FALSE){

            try{

                $sql = "SELECT * FROM user WHERE user.username = :username";
    
                $statement = $connection -> prepare($sql);
    
                $statement -> bindParam(':username',$login);
    
                $statement -> execute();

                return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    
             }catch(PDOException $e){

                echo $e -> getMessage();

             }

         } else {

            try{

                $sql = "SELECT * FROM user WHERE user.mail = :mail";
    
                $statement = $connection -> prepare($sql);
    
                $statement -> bindParam(':mail',$login);
    
                $statement -> execute();

                return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) : false;

    
             }catch(PDOException $e){

                echo $e -> getMessage();

             }
         } 
    }

    public function mdlGetUserInfo($login) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $at = strpos($login,'@',0);

        if($at === FALSE){

            try{

                $sql = "SELECT user.id_user, user.fullname, user.username, user.mail, user.password FROM user WHERE user.username = :username";
    
                $statement = $connection -> prepare($sql);
    
                $statement -> bindParam(':username',$login);
    
                $statement -> execute();

                return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    
             }catch(PDOException $e){

                echo $e -> getMessage();

             }

         } else {

            try{

                $sql = "SELECT user.id_user, user.fullname, user.username, user.mail, user.password FROM user WHERE user.mail = :mail";
    
                $statement = $connection -> prepare($sql);
    
                $statement -> bindParam(':mail',$login);
    
                $statement -> execute();

                return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    
             }catch(PDOException $e){

                echo $e -> getMessage();

             }
         }         
    }

    public static function mdlRegisterUser($fullname, $username, $mail, $password) {

        $db = new Connection();

        $connection = $db -> get_connection();

        print_r($connection);

        $hash = password_hash($password,PASSWORD_BCRYPT);

        $sql = "INSERT INTO user (fullname, username, mail, password) VALUES (:fullname, :username, :mail, :password)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':fullname',$fullname);

        $statement -> bindParam(':username',$username);

        $statement -> bindParam(':mail',$mail);

        $statement -> bindParam(':password',$hash);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;

    }
}

?>