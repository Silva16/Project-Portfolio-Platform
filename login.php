<?php
spl_autoload_register();
/**
 * Created by PhpStorm.
 * User: Silva16
 * Date: 21-04-2015
 * Time: 20:16
 */

use Ainet\Controllers\AuthenticationController;
//test
include('config.php');

$controller = new AuthenticationController;
list($user, $errors) = $controller->signIn();
$title = "Sign In";

require('views/header.view.php');
require('views/users/login.view.php');
require('views/footer.view.php');