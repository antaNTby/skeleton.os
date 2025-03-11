<?php

use flight\debug\tracy\TracyExtensionLoader;
use Symfony\Component\VarDumper\VarDumper;
use Tracy\Debugger;

// Set the default timezone
date_default_timezone_set('Europe/Minsk');

// Set the error reporting level
error_reporting(E_ALL);

// Set the default character encoding
if (function_exists('mb_internal_encoding') === true) {
    mb_internal_encoding('UTF-8');
}

// Set the default locale
if (function_exists('setlocale') === true) {
    // setlocale(LC_ALL, 'en_US.UTF-8');
    setlocale(LC_ALL, 'ru_BY.UTF-8');
}

// Get the $app var to use below
if (empty($app)) {
    $app = Flight::app();
}

// if you want to load classes that have underscores in them, comment out the following line
// Loader::setV2ClassLoading(false);

// This autoloads your code in the app directory so you don't have to require_once everything
$app->path(__DIR__ . $ds . '..' . $ds . '..');

// This is where you can set some flight config variables.
$app->set('flight.base_url', '/');         // if this is in a subdirectory, you'll need to change this
$app->set('flight.case_sensitive', false); // if you want case sensitive routes, set this to true
$app->set('flight.log_errors', true);      // if you want to log errors, set this to true
$app->set('flight.handle_errors', false);  // if you want flight to handle errors, set this to true, otherwise Tracy will handle them
// $app->set( 'flight.views.path', __DIR__ . $ds . '..' . $ds . 'views' ); // set the path to your view/template/ui files
// $app->set( 'flight.views.extension', '.php' );       // set the file extension for your view/template/ui files
$app->set('flight.views.path', __APP__ . $ds . 'tpl'); // set the path to your view/template/ui files
$app->set('flight.views.extension', '.tpl.html');      // set the file extension for your view/template/ui files
$app->set('flight.content_length', true);              // if flight should send a content length header

// dump( $app );

/*
 * Get Tracy up and running
 *
 * There lots of setup options for Tracy! Logs, emails, clicking to
 * open in your editor and a lot more!
 * Check out the docs here:
 * https://tracy.nette.org/
 */
Debugger::enable(); // auto tries to figure out your environment
// Debugger::enable(Debugger::DEVELOPMENT) // sometimes you have to be explicit (also Debugger::PRODUCTION)
// Debugger::enable('23.75.345.200'); // you can also provide an array of IP addresses
Debugger::$logDirectory = __DIR__ . $ds . '..' . $ds . 'log';
Debugger::$strictMode   = true; // display all errors
// Debugger::$strictMode = E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED; // all errors except deprecated notices
if (Debugger::$showBar && php_sapi_name() !== 'cli') {
    $app->set('flight.content_length', false); // if Debugger bar is visible, then content-length can not be set by Flight
    (new TracyExtensionLoader($app));
}
// пример вывода в плавающем окне
//            bdump([1, 3, 5, 7, 9], 'odd numbersuptoten');

// пример вывода в теле сайта
//            $arr=[222,333,44,5555,6,77777];
//            Tracy\Debugger::dump($arr);

// Еще один полезный инструмент – секундомер отладчика с точностью до микросекунд:
//            Tracy\Debugger::timer();
//            // sweet dreams my cherrie
//            sleep(2);
//            $elapsed = Tracy\Debugger::timer();
//            // $elapsed = 2
//            echo $elapsed;
//            dump($elapsed);

### отладчик Symfony\Component\VarDumper
### https://symfony.com/doc/current/components/var_dumper.html#using-the-vardumper-component-in-your-phpunit-test-suite
function sdump($variable)
{
    // Используем VarDumper для дампа переменной
    VarDumper::dump($variable);

    // Используем Debugger для дампа переменной
    // Debugger::dump($variable);
}

/*VarDumper::setHandler(function ($var) {
    // Создаем экземпляр HtmlDumper
    $dumper = new HtmlDumper();

    // Настраиваем опции отображения
    $dumper->setDisplayOptions([
        'maxDepth'        => 5,
        'maxStringLength' => 100,
        // 'fileLinkFormat' => 'file://%f#L%l',
        // 'fileLinkFormat' => 'vscode://file/%f:%l'
        'fileLinkFormat'  => 'subl://open?url=file://%f:%l',
    ]);

    // Устанавливаем тему
    $dumper->setTheme('light');

    // Создаем экземпляр VarCloner
    $cloner = new VarCloner();
    // Вывод дампа в браузер
    $dumper->dump($cloner->cloneVar($var));
}); //VarDumper::setHandler*/

/*
 * This is where you will store database credentials, api credentials
 * and other sensitive information. This file will not be tracked by git
 * as you shouldn't be pushing sensitive information to a public or private
 * repository.
 *
 * What you store here is totally up to you.
 */

const DBMS              = 'mysqli';             //   {$smarty.const.DBMS}          database host   # Database Driver Type (optional)
const DB_DRIVER         = 'mysqli';             //   {$smarty.const.DBMS}          database host   # Database Driver Type (optional)
const DB_HOST           = 'MySQL-5.7';          //   {$smarty.const.DB_HOST}       username # hostname:port (for Port Usage. Example: 127.0.0.1:1010)
const DB_USER           = 'root';               //   {$smarty.const.DB_USER}       database name # Database Name (required)
const DB_PASS           = '';                   //   {$smarty.const.DB_PASS}       database prefix
const DB_NAME           = 'db_antCMS';          //   {$smarty.const.DB_NAME}       password
const DB_PRFX           = 'ant_';               # Database Prefix (optional)
const DB_CHARSET        = 'utf8mb4';            # Database Charset (optional)
const DB_HEADERSCHARSET = 'utf8';               # Database Charset (optional)
const DB_COLLATION      = 'utf8mb4_unicode_ci'; # Database Charset Collation (optional)
const DB_CACHEDIR       = '../admin/database/database_cache';
const DB_PORT           = 3306;

return [
    'database' => [
        'host'     => DB_HOST,
        'dbname'   => DB_NAME,
        'user'     => DB_USER,
        'password' => DB_PASS,

        // uncomment the below 4 lines for mysql
        // 'host' => 'localhost',
        // 'dbname' => 'dbname',
        // 'user' => 'user',
        // 'password' => 'password'
        // uncomment the following line for sqlite
        // 'file_path' => __DIR__ . $ds . '..' . $ds . 'database.sqlite'
    ],

    // this is just here for an example
    // 'google_oauth' => [
    // 	'client_id' => 'client_id',
    // 	'client_secret' => 'client_secret',
    // 	'redirect_uri' => 'redirect_uri'
    // ],
];
