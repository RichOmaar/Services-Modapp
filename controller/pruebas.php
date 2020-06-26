<?php
include '../model/address.model.php';
include '../model/user.model.php';

$idUser = 1;

if(strlen($idUser) > 0){

    $user = new modelUser();
                
    $data = $user -> mdlInfoUser($idUser);

    $idAddres = $data[0]['id_address'];

    //echo json_encode ($idAddres);

    if($data != false){

        $addres = new modelAddress();


        $deleteAddressTableUser = $addres -> mdlDeleteAddressUser($idUser);

        if($deleteAddressTableUser != false){

            $deleAddress = $addres -> mdlDeleteAddress($idAddres);

            if($deleAddress != false){

                $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => Constants::OK_RESPONSE_QUERY));
    
                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            } else {

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_QUERY));

                //$response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'No se hizo el segundo query'));
    
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            }

        } else {

            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_QUERY));
    
            //$response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'No se hizo la primer consulta'));

            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }

    } else {

        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_NO_USER_FOUND));

        echo json_encode($response, JSON_UNESCAPED_UNICODE); 
    }

} else {

    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_NO_USER_FOUND));

    echo json_encode($response, JSON_UNESCAPED_UNICODE); 
}

?>