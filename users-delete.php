<?php

spl_autoload_register();

use Ainet\Controllers\UserController;

session_start();
include('config.php');
if (!isset($_SESSION['authenticated'])){
    header('Location: login.php');
} elseif($_SESSION['user_type'] != 0){
    header('Location: users.php');
}

$controller = new UserController;
$controller->deleteUser();
$title = "Delete users";

require('views/header.view.php');
require('views/list.view.php');
require('views/footer.view.php');