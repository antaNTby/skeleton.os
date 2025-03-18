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
		if ( $this->app->session()->get( 'log' ) !== 'admin' ) {
			bdump( 'middleware worked!' );
			$this->app->redirect( '/login' );
		}
	}
}