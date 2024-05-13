<?php

use App\Controllers\UsersController;
use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// todo: user must be logged in to logout
$routes->get('/logout', [UsersController::class, 'logout']);
