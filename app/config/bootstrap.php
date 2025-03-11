<?php

/*
 * This is the file called bootstrap who's job is to make sure that all the
 * required services, plugins, connections, etc. are loaded and ready to go
 * for every request made to the application.
 */
$ds = DIRECTORY_SEPARATOR;
require __DIR__ . $ds . '..' . $ds . '..' . $ds . 'vendor' . $ds . 'autoload.php';
if ( file_exists( __DIR__ . $ds . 'config.php' ) === false ) {
	Flight::halt( 500, 'Config file not found. Please create a config.php file in the app/config directory to get started.' );
}

// It is better practice to not use static methods for everything. It makes your
// app much more difficult to unit test easily.
// This is important as it connects any static calls to the same $app object
$app = Flight::app();

/*
 * Load the config file
 * P.S. When you require a php file and that file returns an array, the array
 * will be returned by the require statement where you can assign it to a var.
 */
$config = require 'config.php';

// Whip out the ol' router and we'll pass that to the routes file
$router = $app->router();

/*
 * Load the routes file. the $router variable above is passed into the routes.php
 * file below so that you can define routes in that file.
 * A route is really just a URL, but saying route makes you sound cooler.
 * When someone hits that URL, you point them to a function or method
 * that will handle the request.
 */
require 'routes.php';
/*
 * You additionally could just define the routes in this file. It's up to you.
 * Example:
	$router->get('/', function() {
		echo 'Hello World!';
	});
*/

/*
 * Load the services file.
 * A "service" is basically something special that you want to use in your app.
 * For instance, need a database connection? You can set up a database service.
 * Need caching? You can setup a Redis service
 * Need to send email? You can setup a mailgun/sendgrid/whatever service to send emails.
 * Need to send SMS? You can setup a Twilio service.
 *
 * All the services and how they are configured are setup in the services file.
 * In many cases, services are all attached to something called a "services container"
 * or more simply, a "container". The container manages if you should share the same
 * service, or if you should create a new instance of the service every time you need it.
 * That's a discussion for another day. Suffice to say, that Flight has a basic concept
 * of a services container by registering classes to the Engine class.
 */
require 'services.php';

use flight\database\PdoWrapper;

$dsn = 'mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['dbname'] . ';charset=utf8mb4';
Flight::register( 'db', PdoWrapper::class, [$dsn, $config['database']['user'], $config['database']['password']] );

/**
Вот как вы можете использовать Smarty движок шаблонизации для ваших представлений:

// Загрузить библиотеку Smarty
require './Smarty/libs/Smarty.class.php';
 */
// Зарегистрировать Smarty как класс представления
// Также передайте функцию обратного вызова для настройки Smarty при загрузке
use Smarty\Smarty;

Flight::register( 'view', Smarty::class, [], function ( Smarty $smarty ) {
	// $smarty->setTemplateDir( './templates/' );
	// $smarty->setCompileDir( './templates_c/' );
	// $smarty->setConfigDir( './config/' );
	// $smarty->setCacheDir( './cache/' );

	$smarty->setTemplateDir( __APP__ . '/tpl/' ); // здесь лежат шаблоны tpl.html

	$smarty->setCompileDir( __APP__ . '/smarty/compile_dir/' );  // здесь компилируюся *.php
	$smarty->setConfigDir( __APP__ . '/smarty/smarty_config/' ); // незнаю
	$smarty->setCacheDir( __APP__ . '/smarty/smarty_cache/' );
	$smarty->compile_id = 'antFlight_';
	// $smarty->force_compile = true;
	// $smarty->testInstall();

} );
// $smarty = new smarty;
// Для полноты картины вы также должны переопределить метод render по умолчанию в Flight:

Flight::map( 'render', function (
	string $template,
	array  $data
): void {
	Flight::view()->assign( $data );
	Flight::view()->display( $template );
} );

// At this point, your app should have all the instructions it needs and it'll
// "start" processing everything. This is where the magic happens.
$app->start();
/*
 .----..---.  .--.  .----.  .---.     .---. .-. .-.  .--.  .---.    .----. .-. .-..----. .----..-.  .-.
{ {__ {_   _}/ {} \ | {}  }{_   _}   {_   _}| {_} | / {} \{_   _}   | {}  }| { } || {}  }| {}  }\ \/ /
.-._} } | | /  /\  \| .-. \  | |       | |  | { } |/  /\  \ | |     | .--' | {_} || .--' | .--'  }  {
`----'  `-' `-'  `-'`-' `-'  `-'       `-'  `-' `-'`-'  `-' `-'     `-'    `-----'`-'    `-'     `--'
*/
