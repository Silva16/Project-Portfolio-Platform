<?php

namespace Ainet\Support;

use Ainet\Models\User;

class AuthenticationHelper{


    public static function verifyType($task, $id = -1)
    {
        $userAuth = User::find($_SESSION['id']);

        switch($userAuth->type){
            case 0:
                return true;
            case 1:
                return !($task == "add" || $task == "remove");
            case 2:
                return $task == "edit" && $_SESSION['id'] == $id;
            default: return false;
        }
        

    }
    /*public static function verifyType($user)
    {


        if ($user->type == 0){
            return 0;
        }

        if ($user->type == 1){
            return 1;
        }

        if ($user->type == 2){
            return 2;
        }
    }*/

    public static function verifyAuth($user){

        if(!$user){
            return false;
        }

        if (!isset($_SESSION['authenticated'])){
            return false;
        }

        return true;

    }

}