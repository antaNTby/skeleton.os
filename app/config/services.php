<?php

use flight\database\PdoWrapper;
use flight\Engine;
use flight\Session;
use Smarty\Smarty;

/**
 * @var array $config This comes from the returned array at the bottom of the config.php file
 * @var Engine $app
 */

$dsn = 'mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['dbname'] . ';charset=utf8mb4';
Flight::register( 'db', PdoWrapper::class, [$dsn, $config['database']['user'], $config['database']['password']] );

/**
Вот как вы можете использовать Smarty движок шаблонизации для ваших представлений:

// Загрузить библиотеку Smarty
require './Smarty/libs/Smarty.class.php';
 */
// Зарегистрировать Smarty как класс представления
// Также передайте функцию обратного вызова для настройки Smarty при загрузке

Flight::register( 'view', Smarty::class, [], function ( Smarty $smarty ) {

	$smarty->setTemplateDir( __APP__ . '/tpl/' );                // здесь лежат шаблоны tpl.html
	$smarty->setCompileDir( __APP__ . '/smarty/compile_dir/' );  // здесь компилируюся *.php
	$smarty->setConfigDir( __APP__ . '/smarty/smarty_config/' ); // незнаю
	$smarty->setCacheDir( __APP__ . '/smarty/smarty_cache/' );
	$smarty->compile_id    = 'antFlight_';
	$smarty->force_compile = true;
	// $smarty->testInstall();

} );

// Для полноты картины вы также должны переопределить метод render по умолчанию в Flight:
Flight::map( 'render', function (
	string $template = 'index.tpl.html',
	array  $data = []
): void {
	Flight::view()->assign( $data );
	Flight::view()->display( $template );
} );

Flight::map( 'fetch', function (
	string $template = 'index.tpl.html',
	array  $data = []
): void {
	Flight::view()->assign( $data );
	Flight::view()->fetch( $template );
} );

// Регистрация сервиса сессии
/*
$app->register( 'session', Session::class, [
	'save_path'      => __APP__ . '/cache',                 // Каталог для файлов сессий
	'encryption_key' => '11111111000000001111111100000000', // Включить шифрование (рекомендуется 32 байта для AES-256-CBC)
	'auto_commit'    => false,                              // Отключить автоматический коммит для ручного управления
	'start_session'  => true,                               // Автоматически начинать сессию (по умолчанию: true)
	'test_mode'      => false,                              // Включить тестовый режим для разработки
] );
*/

Flight::register( 'session', Session::class );

// dd( $ds );
// uncomment the following line for MySQL
// $dsn = 'mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['dbname'] . ';charset=utf8mb4';

// uncomment the following line for SQLite
// $dsn = 'sqlite:' . $config['database']['file_path'];

// Uncomment the below lines if you want to add a Flight::db() service
// In development, you'll want the class that captures the queries for you. In production, not so much.
// $pdoClass = Debugger::$showBar === true ? PdoQueryCapture::class : PdoWrapper::class;
// $app->register('db', $pdoClass, [ $dsn, $config['database']['user'] ?? null, $config['database']['password'] ?? null ]);

// Got google oauth stuff? You could register that here
// $app->register('google_oauth', Google_Client::class, [ $config['google_oauth'] ]);

// Redis? This is where you'd set that up
// $app->register('redis', Redis::class, [ $config['redis']['host'], $config['redis']['port'] ]);

// $app->register( 'session', Session::class, [__APP__ . '/smarty/smarty_config/', bin2hex( random_bytes( 32 ) )], function ( Session $session ) {
// 	$session->updateConfiguration( [
// 		Session::CONFIG_AUTO_COMMIT => true,
// 	] );
// }
// );