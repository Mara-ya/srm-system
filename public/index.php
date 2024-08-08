<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\MainController;

$requestUri = $_SERVER['REQUEST_URI'];

if ($requestUri === '/') {
    (new MainController())->index();
} elseif ($requestUri === '/login') {
    (new AuthController())->login();
} elseif ($requestUri === '/register') {
    (new AuthController())->register();
} elseif ($requestUri === '/logout') {
    (new AuthController())->logout();
} elseif ($requestUri === '/dashboard/addEntry') {
    (new DashboardController())->addEntry();
} elseif ($requestUri === '/dashboard/editEntry') {
    (new DashboardController())->editEntry();
} elseif ($requestUri === '/dashboard/resetPassword') {
    (new DashboardController())->resetPassword();
} elseif ($requestUri === '/dashboard/showResetPasswordPage') {
    (new DashboardController())->showResetPasswordPage();
} elseif ($requestUri === '/dashboard') {
    (new DashboardController())->index();
} else {
    echo "404 Not Found";
}
