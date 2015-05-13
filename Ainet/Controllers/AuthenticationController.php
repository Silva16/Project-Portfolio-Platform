<?php
/**
 * Created by PhpStorm.
 * User: Silva16
 * Date: 21-04-2015
 * Time: 20:01
 */

namespace Ainet\Controllers;

use Ainet\Models\User;
use Ainet\Support\InputHelper;

class AuthenticationController{

    public function signIn(){

        if (empty($_POST)){

            return [new User, false];
        }

        $users = User::all();

        $email = isset($_POST['email']) ? trim($_POST['email']) : "";
        $password = isset($_POST['password']) ? trim($_POST['password']) : "";

        foreach ($users as $user){

            if($user->email == $email){// && password_verify($password, $user->password)){

                $id = $user->id;

                $errors = $this->validate($user);

                if (count($errors)){
                    return [$user, $errors];
                }

                session_start();

                $_SESSION['id'] = $id;
                $_SESSION['role'] = $user->role;
                $_SESSION['authenticated'] = true;
                $_SESSION['message'] = "Welcome " . $user->name;
                header('Location: users.php');
                exit;
            }
        }

    }

    public function  signOut(){

        session_start();
        $_SESSION = array();

        session_destroy();

        $this->redirectToLogin();

    }

    public function validate($user){

        $errors = [];

        $user->email = InputHelper::post('email');
        if (!$user->email){
            $errors['email'] = "Required field";
        }
        elseif(!filter_var($user->email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Invalid email format';
        }

        $user->password = InputHelper::post('password');
        $user->password = trim($_POST['password']);
        if (!$user->password){
            $errors['password'] = 'Password is required';
        }
        elseif(strlen($user->password) < 8){
            $errors['password'] = 'The password must have at least 8 characters';
        }


        return $errors;

    }

    private function redirectToLogin(){

        header("Location: login.php");
        exit;
    }

}