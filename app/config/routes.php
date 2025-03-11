<?php

use app\controllers\ApiAuthController;
use app\controllers\ApiExampleController;
use flight\Engine;
use flight\net\Router;

/**
 * @var Router $router
 * @var Engine $app
 */
$router->get( '/', function () use ( $app ) {
	// $app->render('welcome', ['message' => 'You are gonna do great things! Goodluck, antaNT']);
} );

$router->get( '/hello-world/@name', function ( $name ) {
	echo '<h1>Hello world! Oh hey ' . $name . '!</h1>';
} );

$router->get( '/companies/@unp', function ( $unp ) {
	echo '<h1>Hello world! Oh hey ' . $unp . '!</h1>';
} );

$router->group( '/api', function () use ( $router, $app ) {
	$Api_Example_Controller = new ApiExampleController( $app );
	$router->get( '/users', [$Api_Example_Controller, 'getUsers'] );
	$router->get( '/users/@id:[0-9]', [$Api_Example_Controller, 'getUser'] );
	$router->post( '/users/@id:[0-9]', [$Api_Example_Controller, 'updateUser'] );
} );
