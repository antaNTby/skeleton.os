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
		$admin_main_content_template = 'login.tpl.html';
		$this->app->render( 'index.tpl.html', [

			'admin_main_content_template' => $admin_main_content_template,
			'SITE_URL'                    => SITE_URL,
			'LOGO256'                     => LOGO256,
			'ACCESS_DENIED_HTML'          => 0,
		] );

		// bdump(
		// 	[
		// 		__DIR__,
		// 		__ROOT__,
		// 		__APP__,
		// 		__PUBLIC__,
		// 		SITE_URL,
		// 		LOGO256,
		// 		LOGO64,

		// 	]
		// );

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
		$url = $this->app->request()->getFullUrl();
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

			bdump(
				[
					$session->id(),
					$session->get( 'log' ),
					$session->get( 'role' ),
					$url,
				] );

			$this->app->view()->assign( 'ACCESS_DENIED_HTML', '' );
			$this->redirect( $url );

			exit;
		}

		$this->redirect( '\login' );
	}
}

/*

session.serialize_handler чем отличается php и php_serialize
Директива session.serialize_handler в PHP определяет метод (обработчик) для сериализации и десериализации данных сессии. Варианты php и php_serialize имеют ключевые различия в подходе к обработке данных:

1. php
Описание: Этот метод использует старый, собственный формат сериализации PHP. Он сохраняет данные в текстовом формате, который компактный и эффективный, но поддерживает только базовые типы данных (массивы, строки, числа).

Особенности:

Более простой, но устаревший формат.

Не поддерживает сериализацию объектов (например, если в сессии есть экземпляры классов).

Ограничен по функциональности в современных версиях PHP.

2. php_serialize
Описание: Этот метод использует встроенные функции serialize() и unserialize() для обработки данных сессии. Это современный стандарт в PHP, рекомендованный для большей гибкости и совместимости.

Особенности:

Поддерживает сложные структуры данных, включая объекты.

Позволяет сериализовать данные, содержащие ссылки.

Широко используется, особенно в современных PHP-проектах.

*/