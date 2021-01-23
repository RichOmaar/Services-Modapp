<?php

use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as Capsule;
use Rakit\Validation\Validator;

class UserController{

    public static function getFollowersList($userId){
        $result = Capsule::table('followers as f1')
            ->selectRaw('f1.id_user_followed, u.id_user, u.fullname, u.username, u.mail, u.image, (SELECT COUNT(*) from followers f2 WHERE f2.id_user_followed = f1.id_user ) as count')
            ->join('user as u', 'f1.id_user', '=', 'u.id_user')
            ->where('f1.id_user_followed', '=', $userId)
            ->get();

        return self::userItemsToArray($result);
    }

    public static function getFollowedUsersList($userId){
        $result = Capsule::table('followers as f1')
            ->selectRaw('f1.id_user_followed, u.id_user, u.fullname, u.username, u.mail, u.image, (SELECT COUNT(*) from followers f2 WHERE f2.id_user_followed = f1.id_user_followed ) as count')
            ->join('user as u', 'f1.id_user_followed', '=', 'u.id_user')
            ->where('f1.id_user', '=', $userId)
            ->get();

        return self::userItemsToArray($result);
    }

    public static function getFollowedStoresList($userId){
        $result = Capsule::table('followers as f1')
            ->selectRaw('f1.id_store_followed, s.id_store, s.store_name, s.image, s.maps, s.status, s.id_client, (SELECT COUNT(*) from followers f2 WHERE f2.id_store_followed = f1.id_store_followed ) as count')
            ->join('store as s', 'f1.id_store_followed', '=', 's.id_store')
            ->where('f1.id_user', '=', $userId)
            ->get();

        return self::storeItemsToArray($result);
    }

    public static function getPersonalMeasurements($userId){
        $measurements = null;
        try {
            $measurements = PersonalMeasurement::findOrfail($userId);
        }
        catch (Exception $exception){
            return ['success' => false, "errors" => ["Usuario no encontrado"]];
        }

        return ['success' => true, "measurements" => ["chest" => $measurements->chest, "waist" => $measurements->waist,
            "hip" => $measurements->hip, "shoulders" => $measurements->shoulders, "weight" => $measurements->weight, "height" => $measurements->height,
            "braSize"=> $measurements->bra_size, "shoeSize" => $measurements->shoe_size]];
    }

    public static function updatePersonalMeasurements($userId, $chest, $waist, $hip, $shoulders, $weight, $height, $braSize, $shoeSize){
        $user = null;
        try {
            $user = User::findOrfail($userId);
        }
        catch (Exception $exception){
            return ['success' => false, "errors" => ["Usuario no encontrado"]];
        }

        $validator = new Validator();
        $validation = $validator->validate(
            ['chest' => $chest, 'waist' => $waist, 'hip' => $hip, 'shoulders' => $shoulders,
                'weight' => $weight, 'height' => $height, 'braSize' => $braSize, 'shoeSize' => $shoeSize],
            ['chest' => 'numeric|min:1|max:300', 'waist' => 'numeric|min:1|max:300', 'hip' => 'numeric|min:1|max:300', 'shoulders' => 'numeric|min:1|max:300',
            'weight' => 'numeric|min:1|max:300', 'height' => 'numeric|min:1|max:300', 'braSize' => 'min:3', 'shoeSize' => 'numeric|min:1|max:300' ]
        );

        if ($validation->fails()){
            $errors = [];

            foreach ($validation->errors()->toArray() as $error){
                foreach ($error as $message){
                    array_push($errors, $message);
                }
            }

            return ["success" => false, "errors" => $errors];
        }

        $pMeasures = PersonalMeasurement::find($userId);
        if ($pMeasures == null){
            $pMeasures = new PersonalMeasurement();
            $pMeasures->user_id = $user->id_user;
        }

        if ($chest != null) $pMeasures->chest = $chest;
        if ($waist != null) $pMeasures->waist = $waist;
        if ($hip != null) $pMeasures->hip = $hip;
        if ($shoulders != null) $pMeasures->shoulders = $shoulders;
        if ($weight != null) $pMeasures->weight = $weight;
        if ($height != null) $pMeasures->height = $height;
        if ($braSize != null) $pMeasures->bra_size = $braSize;
        if ($shoeSize != null) $pMeasures->shoe_size = $shoeSize;

        try {
            $pMeasures->save();
        }
        catch (Exception $exception){
            return ["success" => false, "errors" => [$exception->errorInfo[2]]];
        }

        return ["success" => true, "message" => "Medidas actualizadas correctamente"];

    }

    public static function getUserInfo($userId){
        $user = null;
        try {
            $user = User::findOrfail($userId);
        }
        catch (Exception $exception){
            return ['success' => false, "errors" => ["Usuario no encontrado"]];
        }

        $userInfo = [];

        $userInfo["username"] = $user->username;
        $userInfo["gender"] = $user->gender;
        $userInfo["birthDate"] = $user->birth_date;
        $userInfo["bio"] = $user->bio;

        return ["success" => true, "userInfo" => $userInfo];
    }

    public static function updateUserInfo($userId, $username, $gender, $birthDate, $bio){
        $user = null;
        try {
            $user = User::findOrfail($userId);
        }
        catch (Exception $exception){
            return ['success' => false, "errors" => ["Usuario no encontrado"]];
        }

        if ($username != null)      $user->username = $username;
        if ($gender != null)        $user->gender = $gender;
        if ($birthDate != null)     $user->birth_date = Carbon::parse($birthDate)->format("Y-m-d");
        if ($bio != null)           $user->bio = $bio;

        try {
            $user->save();
        }
        catch (Exception $exception){
            return ["success" => false, "errors" => [$exception->errorInfo[2]]];
        }

        return ["success" => true, "message" => "Información actualizada correctamente"];
    }

    private static function storeItemsToArray($items){
        $storesList = array();

        foreach ($items as $item){
            array_push($storesList, ["id" => $item->id_store, "name" => $item->store_name,
                "image" => $item->image, "maps" => $item->maps, "status" => $item->status,
                "client" => $item->id_client,
                "followerCount" => $item->count]);
        }

        return $storesList;
    }

    private static function userItemsToArray($items){
        $userList = array();

        foreach ($items as $item){
            array_push($userList, ["id" => $item->id_user, "fullname" => $item->fullname,
                "username" => $item->username, 'mail' => $item->mail, "image" => $item->image,
                "followerCount" => $item->count]);
        }

        return $userList;
    }

}