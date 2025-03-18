<?php
//LoginMiddleware.php

namespace app\middleware;

use flight\Engine;
use flight\Session;

class LoginMiddleware {

	/** @var Engine */
	protected Engine $app;

	public function __construct( Engine $app ) {
		$this->app = $app;
	}

	public function before(): void {
		if ( $this->app->session()->get( 'log' ) !== 'ad777min' ) {
			bdump( 'middleware worked!' );
			// $this->app->jsonHalt( ['message' => 'Unauthorized'], 401 );
			$this->app->view()->assign( 'ACCESS_DENIED_HTML', '<div class="alert alert-danger d-flex align-items-center my-5 h2" role="alert">Access Denied - <i class="bi bi-database-slash"></i> - </div>' );
			// $this->app->redirect( '/login' );

			// $admin_main_content_template = 'login.tpl.html';
			// $this->app->render( 'index.tpl.html', [

			// 	'admin_main_content_template' => $admin_main_content_template,
			// 	'SITE_URL'                    => SITE_URL,
			// 	'LOGO256'                     => LOGO256,
			// 	'ACCESS_DENIED_HTML'          => '<div class="alert alert-danger d-flex align-items-center my-5 h2" role="alert">Access Denied - <i class="bi bi-database-slash"></i> - </div>',
			// ] );

		}

	}
}