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
			} else if ( $postData->userlogin === 'editor' ) {
				$session->set( 'role', 'editor' );
			} else {
				$session->set( 'role', 'guest' );
			}
			$session->commit();

			$this->app->set( 'SSSS', '<pre>cewfwe fbregfefb rtnBEFORE BEFORE BEFORE' );

			$this->redirect( '/' );

			exit;
		}

		$this->app->set( 'SSSS', '<pre>BEFORE BEFORE BEFORE' );

		$this->redirect( '\login' );
	}
}
