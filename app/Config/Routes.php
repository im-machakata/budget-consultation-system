<?php

use App\Controllers\DashboardsController;
use App\Controllers\UsersController;
use App\Controllers\MigrationController;
use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('', ['filter' => 'guest'], static function (RouteCollection $routes): void {
    $routes->get('/login', [UsersController::class,  'login']);
    $routes->post('/login', [UsersController::class, 'createSession']);
    $routes->get('/register', [UsersController::class,  'register']);
    $routes->post('/register', [UsersController::class, 'createAccount']);
});

$routes->group('', ['filter' => 'auth'], static function (RouteCollection $routes): void {
    $routes->addRedirect('/', '/dashboard', 301);
    $routes->get('/dashboard', [DashboardsController::class,  'index']);

    // admin user routes
    $routes->group('', ['filter' => 'auth:' . UserRoles::ADMIN], static function (RouteCollection $routes): void {
        $routes->get('/users', [UsersController::class,  'index']);
        $routes->get('/users/ban/(:num)', [UsersController::class,  'ban']);
        $routes->get('/users/edit/(:num)', [UsersController::class,  'edit']);
        $routes->post('/users/edit/(:num)', [UsersController::class,  'update']);
    });
    $routes->get('/logout', [UsersController::class, 'logout']);
});

// migration url 
$routes->get('/_/', [MigrationController::class, 'index']);
