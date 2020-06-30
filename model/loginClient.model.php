<?php

require_once 'connection.php';

class modelLoginClient {

    public function mdlLoginClient ($login,$passLogin){

        $mdlLogin = new modelLoginClient();

        //s$exist = false;

        $response = $mdlLogin -> mdlVerifyClient($login);

        if(!$response){

            return false;

        }else{

            $data = $mdlLogin -> mdlGetClientInfo($login);

            if(password_verify($passLogin,$data[0]['password'])){

                return $data;

            } else {

                return false;

            }
        }

        //return $exist;
    }

    public function mdlVerifyClient($login){

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

                $sql = "SELECT * FROM client WHERE company_name = :companyName";
    
                $statement = $connection -> prepare($sql);
    
                $statement -> bindParam(':companyName',$login);
    
                $statement -> execute();

                return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    
             }catch(PDOException $e){

                echo $e -> getMessage();

             }

         } else {

            try{

                $sql = "SELECT * FROM client WHERE mail = :mail";
    
                $statement = $connection -> prepare($sql);
    
                $statement -> bindParam(':mail',$login);
    
                $statement -> execute();

                return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    
             }catch(PDOException $e){

                echo $e -> getMessage();

             }
         } 
    }

    public function mdlGetClientInfo($login) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $at = strpos($login,'@',0);

        if($at === FALSE){

            try{

                $sql = "SELECT id_client, company_name, mail, name_contact, password FROM client WHERE company_name = :companyName";
    
                $statement = $connection -> prepare($sql);
    
                $statement -> bindParam(':companyName',$login);
    
                $statement -> execute();

                return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    
             }catch(PDOException $e){

                echo $e -> getMessage();

             }

         } else {

            try{

                $sql = "SELECT id_client, company_name, mail, name_contact, password FROM client WHERE mail = :mail";
    
                $statement = $connection -> prepare($sql);
    
                $statement -> bindParam(':mail',$login);
    
                $statement -> execute();

                return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    
             }catch(PDOException $e){

                echo $e -> getMessage();

             }
         }         
    }

    public static function mdlRegisterClient($company_name, $mail, $name_contact, $password) {

        $db = new Connection;

        $connection = $db -> get_connection();

        print_r($connection);

        $hash = password_hash($password,PASSWORD_BCRYPT);

        $sql = "INSERT INTO client (company_name, mail, name_contact, password) VALUES (:company_name, :mail, :name_contact, :password)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':company_name',$company_name);

        $statement -> bindParam(':mail',$mail);

        $statement -> bindParam(':name_contact',$name_contact);

        $statement -> bindParam(':password',$hash);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;

    }
}

?>