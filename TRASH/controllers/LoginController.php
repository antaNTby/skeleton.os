<?php
namespace app\controllers;

use flight\Engine;

class LoginController extends BaseController {
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
		// $this->render( 'login/index.latte', ['page_title' => 'Login'] );
		$this->app->view()->display( __APP__ . '/tpl/login/index.tpl.html' );
		// dd( $this );
	}

	/**
	 * Authenticate
	 *
	 * @return void
	 */
	public function authenticate(): void {
		$postData = $this->request()->data;
		echo( $postData );
		// When you actually do authentication, please use a secure method
		// hashing method like password_hash() and password_verify()
		// also, please don't encrypt passwords. Encrypting is not the same as hashing.
		if ( $postData->password === 'password' ) {
			$this->session()->set( 'user', $postData->username );

			// Sets the current user role
			if ( $postData->username === 'admin' ) {
				$this->session()->set( 'role', 'admin' );
			} else if ( $postData->username === 'editor' ) {
				$this->session()->set( 'role', 'editor' );
			} else {
				$this->session()->set( 'role', 'user' );
			}
			$this->session()->commit();
			$this->redirect( $this->getUrl( 'blog' ) );
			exit;
		}
		$this->redirect( $this->getUrl( 'login' ) );
	}
}