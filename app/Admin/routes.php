<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'InfocreatController@index')->name('admin.home');
    $router->resource('users', UsersController::class);
    $router->resource('roles', RolesController::class);
    $router->resource('permissions', PermissionsController::class);
    $router->resource('projects', ProjectController::class);
    $router->resource('information', InformationsController::class);
    $router->resource('infocreat', InfocreatController::class);
     $router->resource('adminusers', AdminuserController::class);



});
