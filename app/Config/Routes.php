<?php

use App\Controllers\UsersController;
use App\Controllers\MigrationController;
use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// todo: wrap this in a guest middleware
$routes->get('/login', [UsersController::class,  'login']);
$routes->post('/login', [UsersController::class, 'createSession']);

// todo: user must be logged in to logout
$routes->get('/logout', [UsersController::class, 'logout']);

// migration url 
$routes->get('/_/', [MigrationController::class, 'index']);
