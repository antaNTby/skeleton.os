<?php
// temp.php

use app\controllers\ApiAuthController;
use app\controllers\ApiExampleController;
use flight\Engine;
use flight\net\Router;

/**
 * @var Router $router
 * @var Engine $app
 */
// $router->get( '/', function () use ( $app ) {
// 	$app->render( 'welcome', ['message' => 'You are gonna do great things! Goodluck, antaNT'] );
// } );

Flight::route( '/api/versions', function (): void {
	// Don't do this in your houses, only for testing purposes 🚫
	$composerJson = json_decode( file_get_contents( ROOT . '/composer.json' ), true );
	// $packageJson  = json_decode( file_get_contents( ROOT . '/package.json' ), true );

	echo json_encode( [
		$composerJson['require']['flightphp/core'],
		// $packageJson['devDependencies']['svelte'],
	] );
} );

Flight::route( '/api/auth', function (): void {
	if ( session_status() !== PHP_SESSION_ACTIVE ) {
		session_start();
	}

	$userId    = $_SESSION['auth.user.id'] ?? null;
	$userEmail = $_SESSION['auth.user.email'] ?? null;

	Flight::json( [
		'isLogged' => $userId !== null,
		'email'    => $userEmail,
	] );
} );

// Home Page
$router->get( '/', \app\controllers\HomeController::class . '->index' )->setAlias( 'home' );

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

// Login
$router->get( '/login', \app\controllers\LoginController::class . '->index' )->setAlias( 'login' );
$router->post( '/login', \app\controllers\LoginController::class . '->authenticate' )->setAlias( 'login_authenticate' );

$router->get( '/logout', \app\controllers\LogoutController::class . '->index' )->setAlias( 'logout' );

##############   // And empty group just simply groups together routes where you can assign a middleware.
##############   $router->group( '', function ( Router $router ) {
##############
##############   	// Protected Posts
##############   	$router->get( '/create', \app\controllers\PostController::class . '->create' )->setAlias( 'blog_create' );
##############   	$router->post( '', \app\controllers\PostController::class . '->store' )->setAlias( 'blog_store' );
##############   	$router->get( '/@id/edit', \app\controllers\PostController::class . '->edit' )->setAlias( 'blog_edit' );
##############   	$router->post( '/@id/edit', \app\controllers\PostController::class . '->update' )->setAlias( 'blog_update' );
##############   	$router->get( '/@id/delete', \app\controllers\PostController::class . '->destroy' )->setAlias( 'blog_destroy' );
##############
##############   	// Comments
##############   	$router->post( '/@id/comment', \app\controllers\CommentController::class . '->store' )->setAlias( 'comment_store' );
##############   	$router->get( '/@id/comment/@comment_id/delete', \app\controllers\CommentController::class . '->destroy' )->setAlias( 'comment_destroy' );
##############   }, [LoginMiddleware::class] );
