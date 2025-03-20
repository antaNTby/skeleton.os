<?php
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

		// прверяем совпадает ли авторизованный пользователь с admin
		if ( $this->app->session()->get( 'log' ) !== 'admin' ) {
			$this->app->halt( 401, '<a href="/login"> 401-Unauthorized </a>' );
			// $this->app->jsonHalt( ['message' => 'Unauthorized'], 401 );
			// $this->app->redirect( ' / login' );
		}

	}

	public function after(): void {
		bdump( 'AFTER' );
	}

}