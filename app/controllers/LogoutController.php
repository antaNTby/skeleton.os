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