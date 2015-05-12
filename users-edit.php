<?php

spl_autoload_register();

use Ainet\Controllers\UserController;

session_start();
include('config.php');
if (!isset($_SESSION['authenticated'])){
    header('Location: login.php');
}

$controller = new UserController;
list($user, $errors) = $controller->editUser();
$title = "Edit users";

require('views/header.view.php');
require('views/users/edit.view.php');
require('views/footer.view.php');