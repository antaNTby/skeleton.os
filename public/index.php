<?php
ini_set( 'session.serialize_handler', 'php_serialize' );

$ds = DIRECTORY_SEPARATOR;
define( '__ROOT__', __DIR__ . $ds . '..' );
define( '__APP__', dirname( __DIR__, 1 ) . $ds . 'app' );
define( '__CORE__', dirname( __DIR__, 1 ) . $ds . 'core' );
define( '__PUBLIC__', dirname( __DIR__, 1 ) . $ds . 'public' );

/** Absolute path to project root */
// Назначить данные шаблона
const SITE_URL = '--== SKELETON ==--';
const LOGO256  = 'logo256.jpg'; //   {$smarty.const.LOGO256}
const LOGO64   = 'logo64.jpg';  //   {$smarty.const.LOGO64}

// require __DIR__ . $ds . '..' . $ds . 'app' . $ds . 'config' . $ds . 'bootstrap.php';
require __APP__ . $ds . 'config' . $ds . 'bootstrap.php';

/**/
