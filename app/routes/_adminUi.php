<?php

use app\middleware;
use flight\Engine;
use flight\Session;

Flight::route( '/login', \app\controllers\LoginController::class . '->index' )->setAlias( 'login' );
Flight::route( '/logout', \app\controllers\LogoutController::class . '->index' )->setAlias( 'logout' );

Flight::route( 'POST /authenticate', \app\controllers\LoginController::class . '->authenticate' )->setAlias( 'authenticate' );

// Flight::route( '/logout', function () {
// 	$session = Flight::session();
// 	$session->clear(); // Очистить все данные сессии
// 	Flight::json( ['message' => 'Успешный выход'] );
// } );

$LoginMiddleware = new middleware\LoginMiddleware( $app );
Flight::route( '*', function () {
	$admin_main_content_template = 'admin.tpl.html';
	Flight::render( 'index.tpl.html', ['admin_main_content_template' => $admin_main_content_template] );
} )->addMiddleware( $LoginMiddleware );
