<?php

namespace Ainet\Controllers;

use Ainet\Models\User;
use Ainet\Support\InputHelper;
use Ainet\Support\AuthenticationHelper;

class UserController{


    public function listUsers()
    {
        $users = User::all();

        return $users;
    }

    public function addUser()
    {
        $userAuth = User::find($_SESSION['id']);

        if (AuthenticationHelper::verifyAuth($userAuth) != true){
            redirectToLogin();
        }

        if (!(AuthenticationHelper::verifyType("add"))){
            $this->redirectToHome();
        }
        //Ver se o post esta vazio, Se estiver vazio, é  return [new User, false]
        if (empty($_POST)){
            return [new User, false];
        }
        //Se carregar em cancel, redericciona para users.php
        if (InputHelper::post('cancel')){
            $this->redirectToHome();
        }
        //Se carregar em submit,
        //   Faz validação dos campos
        $user = new User;
        $errors = $this->validate($user);
        //   Se houver erros faz return [new User, Error[]]
        if (count($errors)){
            return [$user, $errors];
        }
        // chama o User::add

        $hash = password_hash($user->password, PASSWORD_DEFAULT);
        $user->password = $hash;

        User::add($user);
        $this->redirectToHome();
    }

    public function editUser()
    {
        $userAuth = User::find($_SESSION['id']);
        $id = InputHelper::get('id');
        $user = User::find($id);

        if (AuthenticationHelper::verifyAuth($userAuth) != true){
            redirectToLogin();
        }

        if (!(AuthenticationHelper::verifyType("edit", $id))){
            $this->redirectToHome();
        }

        if (empty($_POST)){

            if (!$id){
                $this->redirectToHome();
            }

            if (!$user){
                $this->redirectToHome();
            }

            return [$user, false];
        }


        if (InputHelper::post('cancel')){
            $this->redirectToHome();
        }


        $id = InputHelper::post('user_id');

        if (!$id){
            $this->redirectToHome();
        }

        $checkEdit = true;

        $errors = $this->validate($user, $checkEdit);
        $user->id = $id;

        //   Se houver erros faz return [new User, Error[]]
        if (count($errors)){
            return [$user, $errors];
        }

        User::save($user);

        $this->redirectToHome();
    }

    public function deleteUser()
    {
        $userAuth = User::find($_SESSION['id']);

        if (AuthenticationHelper::verifyAuth($userAuth) != true){
            redirectToLogin();
        }

        if (!(AuthenticationHelper::verifyType("remove"))){
            $this->redirectToHome();
        }

        $id = InputHelper::post('id');

        if (!$id){
            $this->redirectToHome();
        }

        User::delete($id);
        $this->redirectToHome();
    }


    public function validate($user, $checkEdit = false){

        $errors = [];

        $user->fullname = InputHelper::post('fullname');
        if (!$user->fullname){
            $errors['fullname'] = "Required field";
        }
        elseif(!preg_match("/^[a-zA-Z ]+$/",$user->fullname)){
            $errors['fullname'] = "Name must have only letters or spaces";
        }

        $user->email = InputHelper::post('email');
        if (!$user->email){
            $errors['email'] = "Required field";
        }
        elseif(!filter_var($user->email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Invalid email format';
        }

        if ($checkEdit == false){
            $user->password = InputHelper::post('password');
            $user->password = trim($_POST['password']);
            if (!$user->password){
                $errors['password'] = 'Password is required';
            }
            elseif(strlen($user->password) < 8){
                $errors['password'] = 'The password must have at least 8 characters';
            }
        }


        $user->type = InputHelper::post('type');
            if($user->type == "----------") {
                $errors['type'] = "Select a field";
            }elseif (!array_key_exists($user->type, User::$roles)){
                $errors['type'] = 'Type not exists!';
            }



        return $errors;

    }

    public function redirectToHome(){

        header("Location: users.php");
        exit;
    }

    public function redirectToLogin(){

        header("Location: login.php");
        exit;
    }



}