<?php
namespace app\controllers;

use flight\Engine;

class ApiAuthController {

	protected Engine $app;

	public function __construct( $app ) {
		$this->app = $app;
	}

}