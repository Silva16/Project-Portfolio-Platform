<?php
/**
 * Created by PhpStorm.
 * User: Silva16
 * Date: 24-04-2015
 * Time: 16:49
 */

namespace Ainet\Models;
use mysqli;



class AbstractModel {


    public static function dbConnection()
    {
        //include('../../config.php');

        global $config;
        $db = $config['database'];

        try {
            $conn = new \mysqli($db['host'], $db['user'], $db['pass'], $db['name'], $db['port']);
        } catch(Exception $e) {
            die('Message: ' .$e->getMessage());
        }

        return $conn;
    }

    public static function dbClose($conn)
    {
        try{
            $conn->close();
        } catch(Exception $e){
            die('Message: ' .$e->getMessage());
        }

    }

    public static function dbQuery($conn, $user, $query, $checkEdit = false)
    {
        if ($statement = $conn->prepare($query)) {

            if ($checkEdit == false) {
                $statement->bind_param("ssssi", $user->name, $user->email, $user->password, $user->registeredAt, $user->role);
            } else {
                $statement->bind_param("sssi", $user->name, $user->email, $user->type, $user->id);
            }

            $statement->execute();
            $statement->close();
        }else{
            //var_dump($conn->error);
            var_dump($query);
        }




    }


}