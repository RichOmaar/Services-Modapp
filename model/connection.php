<?php

class Connection {
    public function get_connection(){ 
        $user = "root";
        $pass = "root";
        $host = "localhost";
        $db = "modapp";
        $connection = new PDO("mysql:host={$host}; dbname={$db};", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        return ($connection);
    }
}
//ESto lo ten
class Response implements JsonSerializable {
    protected $status;  
    protected $message; 

    public function __construct(array $data) {
        $this->status = $data['status'];       
        $this->message = $data['message'];       
    }

    public function jsonSerialize() {
        return [
            'status'   => $this->status,
            'message' => $this->message
        ];
    }
}

class ResponseNews implements JsonSerializable {
    protected $status;  
    protected $news; 

    public function __construct(array $data) {
        $this->status = $data['status'];       
        $this->news = $data['news'];       
    }

    public function jsonSerialize() {
        return [
            'status'   => $this->status,
            'news' => $this->news
        ];
    }
}

class Constants {
    const BAD_RESPONSE = 'BAD';
    const BAD_RESPONSE_DESCRIPTION = 'Ha ocurrido un error intenta nuevamente';
    const BAD_RESPONSE_NO_USER_FOUND = 'No se encontró ningún usuario con ese nombre, verifica e intenta nuevamente';
    const BAD_RESPONSE_NO_USER_INGENIO_FOUND = 'No se encontró ningún usuario relacionado con ese ingenio, verifica e intenta nuevamente';
    const BAD_RESPONSE_NO_USER_DEPARTMNET_FOUND = 'No se encontró ningún usuario relacionado con ese departamento, verifica e intenta nuevamente';
    const BAD_POST_RESPONSE = 'La petición POST no se hizo correctamente';
    const BAD_POST_RESPONSE_NO_PRODUCT = 'No se encontró ningún producto con ese id';
    
    const BAD_RESPONSE_DESCRIPTION_COMPANY_NO_SERVICE = 'No se encontró ninguna empresa con el servicio que estás buscando';
    const BAD_RESPONSE_DESCRIPTION_COMPANY_NO_FOUND = 'No se encontró ninguna empresa con ese nombre, verifica e intenta nuevamente';
    const BAD_RESPONSE_DESCRIPTION_COMPANY_NO_LOCATION = 'No se encontró ninguna empresa en ese estado, verifica e intenta nuevamente';

    const OK_RESPONSE = 'OK';
    const OK_RESPONSE_QUERY = 'Se realizó la consulta';
    const BAD_RESPONSE_QUERY = 'No se realizó la consulta';

    const SERVER_PATH = "http://localhost:8888/";
    const FOLDER_IMAGE_USER = "imagesUser/";
    const FOLDER_IMAGE_CLIENT = "imagesClient/";
    const FOLDER_IMAGE_INGE = "imagesInge/";
    const FOLDER_IMAGE_NEWS = "imagesNews/";
}

?>