<?php

require_once 'connection.php';

class modelDataClient {

    //Primera vista datos de contacto
    public function mdlUpdateContactData($name_contact, $tel, $idClient) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE client SET name_contact = :name_contact, tel = :tel WHERE id_client = :idClient";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':name_contact', $name_contact);

        $statement -> bindParam(':tel', $tel);

        $statement -> bindParam(':idClient', $idClient);

        $statement -> execute();

        return ($statement);
    }

    public function mdlInfoContactData ($idClient) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT name_contact, tel FROM client WHERE id_client = :idClient";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idClient', $idClient);

        $statement -> execute();

        return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) :  false;
    }
    //

    //Información de la compañía
    public function mdlInfoCompanyData ($idClient) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT image, company_name, company_mail, company_tel, rfc, description FROM client WHERE id_client = :id_client";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_client', $idClient);

        $statement -> execute();

        return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) :  false;

    }

    public function mdlUpdateCompanyData ($image, $companyName, $companyMail, $companyTel, $rfc, $description, $idClient) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE client SET image = :image, company_name = :company_name, company_mail = :company_mail, company_tel = :company_tel, rfc = :rfc, description = :description WHERE id_client = :idClient";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':image', $image);

        $statement -> bindParam(':company_name', $companyName);

        $statement -> bindParam(':company_mail', $companyMail);

        $statement -> bindParam(':company_tel', $companyTel);

        $statement -> bindParam(':rfc', $rfc);

        $statement -> bindParam(':description', $description);

        $statement -> bindParam(':idClient', $idClient);

        $statement -> execute();

        return $statement;

    }
    //

    //Dirección fiscal
    public function mdlAddFiscalAddress($idClient, $state, $municipio, $street, $numberSt, $numberInt, $cp) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO address (state, municipio, street, number_st, number_int, cp) VALUES (:state, :municipio, :street, :number_st, :number_int, :cp)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':state' ,$state);

        $statement -> bindParam(':municipio', $municipio);

        $statement -> bindParam(':street', $street);

        $statement -> bindParam(':number_st', $numberSt);

        $statement -> bindParam(':number_int', $numberInt);

        $statement -> bindParam(':cp', $cp);

        $statement -> execute();

        $last_id = $connection -> lastInsertId();

        return ($last_id);

        /*
        if($statement == true){

            //$last_id = $connection -> lastInsertId();

            $sql = "UPDATE `client` SET `id_address` = :id_address WHERE id_client = :id_client";

            $statementUp = $connection -> prepare($sql);

            $statementUp -> bindParam(':id_address', $last_id);

            $statementUp -> bindParam(':id_client', $idClient);

            $statementUp -> execute();

            return ($statementUp);

        } else {
            
            return false;
        }
*/
    }

    public function mdlUpdateFiscalAddress($idClient, $state, $municipio, $street, $numberSt, $numberInt, $cp) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE address SET state = :state, municipio = :municipio, street = :street, number_st = :number_st, number_int = :number_int, cp = :cp WHERE id_address = (SELECT * FROM (SELECT client.id_address FROM client LEFT JOIN address ON client.id_address = address.id_address WHERE client.id_client = :idUser)example)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_client', $idClient);

        $statement -> bindParam(':state', $state);
        
        $statement -> bindParam(':municipio',$municipio);

        $statement -> bindParam(':street',$street);

        $statement -> bindParam(':number_st',$numberSt);

        $statement -> bindParam(':number_int',$numberInt);

        $statement -> bindParam(':cp',$cp);

        $statement -> bindParam(':idUser',$idUser);

        $statement -> execute();

        return $statement;

    }

    public function mdlInfoFiscalAddress($idClient) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT address.id_address, address.state, address.municipio, address.street, address.number_st, address.number_int, address.cp FROM client LEFT JOIN address ON client.id_address = address.id_address WHERE client.id_client = :id_client";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_client', $idClient);

        $statement -> execute();

        return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function mdlDeleteFiscalAddress($idClient, $idAddress){

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE client SET id_address = NULL WHERE id_client = :idUser";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idUser', $idClient);

        $statement -> execute();

        if($statement -> rowCount() > 0) {

            $connection = $db -> get_connection();

            $sql = "DELETE FROM address WHERE id_address = :id_address";

            $statement = $connection -> prepare($sql);

            $statement -> bindParam(':id_address', $idAddress);

            $statement -> execute();

            return $statement;

        } else {

            return false;
        }

    }

}

?>