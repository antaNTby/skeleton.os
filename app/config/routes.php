<?php

use app\middleware;
use flight\Engine;
use flight\Session;

foreach ( glob( __APP__ . '/routes/_*.php' ) as $fileName ) {
	require $fileName;
}

$LoginMiddleware = new middleware\LoginMiddleware( $app );
Flight::route( '*', function () {
/*	Flight::render( 'layouts/base', [] );*/
	$admin_main_content_template = 'admin.tpl.html';
	Flight::render( 'index.tpl.html', ['admin_main_content_template' => $admin_main_content_template] );
} )->addMiddleware( $LoginMiddleware );
