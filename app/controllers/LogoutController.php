<?php
namespace app\controllers;

use flight\Engine;
use flight\Session;

### use Ghostff\Session\Session;

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
		$session = $this->session();
		$session->delete( 'log' );
		$session->delete( 'role' );
		$session->destroy( $session->id() );
		$this->redirect( '\login' );
	}
}
