<?php
namespace app\controllers;

use flight\Engine;
use flight\Session;

### use Ghostff\Session\Session;

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
		$this->app->render( 'login.tpl.html', [
			'SITE_URL'           => SITE_URL,
			'LOGO256'            => LOGO256,
			'ACCESS_DENIED_HTML' => 0,
			'base_url'           => __PUBLIC__,
		] );

	}

	/**
	 * Authenticate
	 *
	 * @return void
	 */
	public function authenticate(): void {

		$session  = $this->session();
		$postData = $this->request()->data;
		// Вы можете получить доступ к полному URL запроса, используя метод getFullUrl():
		$url      = $this->app->request()->getFullUrl();
		$referrer = $this->app->request()->referrer;
		// dd( $postData );
		if ( $postData->userpw === '555' ) {
			$session->set( 'log', $postData->userlogin );
			// bdump( [$postData, 'strrrr' => "userpw === '555'"] );

			// Sets the current user role
			if ( $postData->userlogin === 'admin' ) {
				$session->set( 'role', 'root' );
			} else if ( $postData->userlogin === 'user' ) {
				$session->set( 'role', 'user' );
			} else {
				$session->set( 'role', 'guest' );
			}
			$session->commit();
			$this->redirect( '/' );

			exit;
		}
		$this->redirect( '\login' );
	}
	user;
	public function logout(): void {
		$session = $this->session();
		$session->delete( 'log' );
		$session->delete( 'role' );
		$session->commit();
		$session->destroy( $session->id() );
		$this->redirect( '\login' );
	}
}
