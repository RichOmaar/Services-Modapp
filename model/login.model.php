<?php

require_once 'conexion.php';

class modelLogin {
    public function mdlLogin ($login,$passLogin){
        $mdlLogin = new modelLogin();
        $exist = false;

        if($mdlLogin -> mdlVerifyUser($login)){

            $data = $mdlLogin -> mdlGetUserInfo($login);

            if(password_verify($passLogin,$data['password'])){

                return $data;
            } else {
                return false;
            }

        }

        return $exist;
    }

    public function mdlVerifyUser($login){

         $db = new Connection();

         $connection = $db -> get_connection();


         $sql = "SELECT * FROM user WHERE user.mail = :mail";

         if(!$sql){

             $sql = "SELECT * FROM user WHERE user.username = :username";

             $statement = $connection -> prepare($sql);

             $statement -> bindParam(':username',$login);

             if(!$statement){
                return false;
            } else{
                $statement -> execute();
                return true;
            }

         } else {
             
            $sql = "SELECT * FROM user WHERE user.mail = :mail";

            $statement = $connection -> prepare($sql);

            $statement -> bindParam(':mail',$login);

            if(!$statement){
               return false;
           } else{
               $statement -> execute();
               return true;
           }
           
         }

    }

    public function mdlGetUserInfo($login) {
        
        $array = NULL;

         $db = new Connection();

         $connection = $db -> get_connection();

         $sql = "SELECT user.id_user, user.fullname, user.username, user.mail, user.password FROM user WHERE user.mail = :mail";

         if(!$sql){

            $sql = "SELECT user.id_user, user.fullname, user.username, user.mail, user.password FROM user WHERE user.mail = :username";

            $statement = $connection -> prepare($sql);

            $statement -> bindParam(':username',$login);

            if(!$statement){
               return false;
           } else{
               $statement -> execute();
               
               while ($result = $statement -> fetch()) {
                   $array[] = $result;
               }

               return $array;

            }

        } else {
            
           $sql = "SELECT user.id_user, user.fullname, user.username, user.mail, user.password FROM user WHERE user.mail = :mail";

           $statement = $connection -> prepare($sql);

           $statement -> bindParam(':mail',$login);

           if(!$statement){
              return false;
          } else{
              $statement -> execute();
              
              return ($statement -> fetchAll(PDO::FETCH_ASSOC));
            }

            return $array;
          }
    }

    public static function mdlRegisterUser($fullname, $username, $mail, $password) {

        $db = new Connection;

        $connection = $db -> get_connection();

        $hash = password_hash($password,PASSWORD_BCRYPT);

        $sql = "INSERT INTO user (fullname, username, mail, 'password') VALUES (:fullname, :username, :mail, :password)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':fullname',$fullname);

        $statement -> bindParam(':username',$username);

        $statement -> bindParam(':mail',$mail);

        $statement -> bindParam(':password',$hash);

        $statement -> execute();

        if($statement->rowCount() > 0){

            return true;

        } else {

            return false;
        }
    }

    
}

?>