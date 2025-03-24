<?php

use app\middleware;
use flight\Engine;
use flight\net\Router;
use flight\Session;

$LoginMiddleware = new middleware\LoginMiddleware( $app );
// Home Page
$router->get( '/', \app\admin\DptController::class . '->showSub' )->setAlias( 'home' );

// Blog
$router->group( '/sub', function ( Router $router ) {

	$router->get( '/@sub', \app\admin\DptController::class . '->showSub' )->setAlias( 'showSub' );
	$router->get( '/@sub/@id', \app\admin\DptController::class . '->editSub' )->setAlias( 'editSub' );

} );

Flight::route( 'POST /authenticateME', \app\controllers\LoginController::class . '->authenticate' )->setAlias( 'authenticate' );

Flight::route( '/cls', function () {
	echo 'log.ini очищен!';
	\cls();
} );
Flight::route( '/login', \app\controllers\LoginController::class . '->index' )->setAlias( 'login' );
Flight::route( '/logout', \app\controllers\LoginController::class . '->logout' )->setAlias( 'logout' );

Flight::route( '*', function () {
	$admin_main_content_template = 'admin.tpl.html';

	Flight::render( 'index.tpl.html', [
		'admin_main_content_template' => $admin_main_content_template,
		'container_width'             => 'container-xxl',
		'ACCESS_DENIED_HTML'          => Flight::get( 'ACCESS_DENIED_HTML' ),
		'admin_main_content_template' => $admin_main_content_template,
		'base_url'                    => __PUBLIC__,
	] );
} )->addMiddleware( $LoginMiddleware );
