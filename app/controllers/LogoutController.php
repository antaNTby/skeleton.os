<?php

namespace app\controllers;
use flight\Engine;

class LogoutController extends BaseController {
	/**
	 * Index
	 *
	 * @return void
	 */

	protected Engine $app;

	public function __construct( $app ) {
		$this->app = $app;
	}

	public function index(): void {
		$this->session()->destroy();
		$this->redirect( $this->getUrl( 'blog' ) );
	}
}