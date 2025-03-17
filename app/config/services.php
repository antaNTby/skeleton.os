<?php

use flight\database\PdoWrapper;

/**
 * @var array $config This comes from the returned array at the bottom of the config.php file
 * @var Engine $app
 */

use flight\Engine;

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
	string $template,
	array  $data = []
): void {
	Flight::view()->assign( $data );
	Flight::view()->display( $template );
} );

Flight::map( 'fetch', function (
	string $template,
	array  $data = []
): void {
	Flight::view()->assign( $data );
	Flight::view()->fetch( $template );
} );

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
