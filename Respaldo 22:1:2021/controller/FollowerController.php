<?php

class FollowerController {

    const USER = "user";
    const STORE = "store";

    public static function follow($userId, $toFollowId, $type){

        if ($type == self::USER && self::relationExists($userId, $toFollowId, null))
            return ["success" => false, "message" => "Ya se esta siguiendo a este usuario"];
        else if ($type == self::STORE && self::relationExists($userId, null, $toFollowId))
            return ["success" => false, "message" => "Ya se está siguiendo a esta marca"];

        try {
            $user = User::findOrFail($userId);
            $followerModel = new Follower();
            $followerModel->id_user = $user->id_user;

            switch ($type){
                case self::USER :
                    $toFollowUser = User::findOrFail($toFollowId);
                    if ($user->id_user == $toFollowUser->id_user)
                        return ["success" => false, "message" => "Los ids deben ser diferentes"];

                    $followerModel->id_user_followed = $toFollowUser->id_user;
                    $followerModel->save();
                    return ["success" => true, "message" => "Se empezó a seguir usuario"];

                case self::STORE:
                    $toFollowStore = Store::findOrFail($toFollowId);
                    $followerModel->id_store_followed = $toFollowStore->id_store;
                    $followerModel->save();
                    return ["success" => true, "message" => "Se empezó a seguir marca"];

                default:
                    return ["success" => false, "message" => "Tipo de usuario no válido"];
            }
        }
        catch (Exception $exception){
            return ["success" => false, "message" => "Ids no reconocidos"];
        }
    }

    public static function unfollow($userId, $toUnfollowId, $type){
        if ($type == self::USER && ! self::relationExists($userId, $toUnfollowId, null))
            return ["success" => false, "message" => "No estás siguiendo al usuario"];
        else if ($type == self::STORE && ! self::relationExists($userId, null, $toUnfollowId))
            return ["success" => false, "message" => "No estás siguiendo a esta marca"];

        $followerModel = null;
        try {
            switch ($type){
                case self::USER:
                    $followerModel = Follower::where('id_user', '=', $userId)
                        ->where('id_user_followed', '=', $toUnfollowId)
                        ->firstOrFail();
                    break;

                case self::STORE:
                    $followerModel = Follower::where('id_user', '=', $userId)
                        ->where('id_store_followed', '=', $toUnfollowId)
                        ->firstOrFail();
                    break;

                default:
                    return ["success" => false, "message" => "Tipo de usuario no válido"];
            }

        }
        catch (Exception $exception){
            return ["success" => false, "message" => "Ids no reconocidos"];
        }

        if ( $followerModel->delete() ){
            return ["success" => true, "message" => "Dejando de seguir"];
        }

        return ["success" => false, "message" => "Ha ocurrido un error"];
    }

    private static function relationExists($userId, $toFollowUserId, $toFollowStoreId){
        try {
            Follower::where('id_user', '=', $userId)
                ->where('id_user_followed', '=', $toFollowUserId)
                ->where('id_store_followed', '=', $toFollowStoreId)
                ->firstOrFail();

            return true;
        }
        catch (Exception $exception){
            return false;
        }
    }

}
