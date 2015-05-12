<?php
/**
 * Created by PhpStorm.
 * User: Silva16
 * Date: 22-04-2015
 * Time: 03:00
 */

spl_autoload_register();

use Ainet\Controllers\AuthenticationController;

$controller = new AuthenticationController;
$controller->signOut();
$title = "Sign Out";