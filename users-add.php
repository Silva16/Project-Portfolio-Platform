<?php

session_start();

spl_autoload_register();

use Ainet\Controllers\UserController;

include('config.php');
$controller = new UserController;
list($user, $errors) = $controller->addUser();
$title = "Add users";

require('views/header.view.php');
require('views/users/add.view.php');
require('views/footer.view.php');


