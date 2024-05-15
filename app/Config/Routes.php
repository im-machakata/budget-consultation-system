<?php

use App\Controllers\DashboardsController;
use App\Controllers\UsersController;
use App\Controllers\MigrationController;
use App\Controllers\ReportsController;
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
    $routes->get('/reports', [ReportsController::class,  'index']);

    // admin user routes
    $routes->group('', ['filter' => 'auth:' . UserRoles::ADMIN], static function (RouteCollection $routes): void {
        $routes->get('/users', [UsersController::class,  'index']);
        $routes->get('/users/ban/(:num)', [UsersController::class,  'ban']);
        $routes->get('/users/unban/(:num)', [UsersController::class,  'unban']);
        $routes->get('/users/edit/(:num)', [UsersController::class,  'edit']);
        $routes->post('/users/edit/(:num)', [UsersController::class,  'update']);
    });

    // executive user routes
    $routes->group('', ['filter' => 'auth:' . UserRoles::EXECUTIVE], static function (RouteCollection $routes): void {
        $routes->post('/reports', [ReportsController::class,  'create']);
    });

    $routes->get('/logout', [UsersController::class, 'logout']);
});

// migration url 
$routes->get('/_/', [MigrationController::class, 'index']);
