<?php
namespace app\controllers;

use flight\Engine;
use Ghostff\Session\Session;

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

		// $this->app->view()->display( __APP__ . '/tpl/login.tpl.html' );

		$admin_main_content_template = 'login.tpl.html';
		$this->app->render( 'index.tpl.html', [

			'admin_main_content_template' => $admin_main_content_template,
			'SITE_URL'                    => SITE_URL,
			'LOGO256'                     => LOGO256,
			'ACCESS_DENIED_HTML'          => 0,
		] );

		bdump(
			[
				__DIR__,
				__ROOT__,
				__APP__,
				__PUBLIC__,
				SITE_URL,
				LOGO256,
				LOGO64,

			]
		);

	}

	/**
	 * Authenticate
	 *
	 * @return void
	 */
	public function authenticate(): void {
		$postData = $this->request()->data;
		// dd( $postData );
		if ( $postData->userpw === '555' ) {
			$this->session()->set( 'log', $postData->userlogin );
			bdump( [$postData, 'strrrr' => "userpw === '555'"] );

			// Sets the current user role
			if ( $postData->userlogin === 'admin' ) {
				$this->session()->set( 'role', 'admin' );
			} else if ( $postData->userlogin === 'editor' ) {
				$this->session()->set( 'role', 'editor' );
			} else {
				$this->session()->set( 'role', 'user' );
			}
			$this->session()->commit();
			bdump( $this->session() );

			$this->redirect( '/' );

			exit;
		}

		$this->redirect( $this->getUrl( 'login' ) );
	}
}