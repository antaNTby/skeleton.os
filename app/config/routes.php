<?php

foreach ( glob( __APP__ . '/routes/_*.php' ) as $fileName ) {
	require $fileName;
}

Flight::route( '*', function () {
/*	Flight::render( 'layouts/base', [] );*/
	$admin_main_content_template = 'admin.tpl.html';
	Flight::render( 'index.tpl.html', ['admin_main_content_template' => $admin_main_content_template] );
} );
