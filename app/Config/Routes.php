<?php

use App\Controllers\UsersController;
use App\Controllers\MigrationController;
use App\Filters\IsAuthenticated;
use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('', ['filter' => 'guest'], static function (RouteCollection $routes): void {
    $routes->get('/login', [UsersController::class,  'login']);
    $routes->post('/login', [UsersController::class, 'createSession']);
});

$routes->group('', ['filter' => 'auth'], static function (RouteCollection $routes): void {
    $routes->get('/logout', [UsersController::class, 'logout']);
});

// migration url 
$routes->get('/_/', [MigrationController::class, 'index']);
