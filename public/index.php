<?php

/*
 * FlightPHP Framework
 * @copyright   Copyright (c) 2024, Mike Cao <mike@mikecao.com>, n0nag0n <n0nag0n@sky-9.com>
 * @license     MIT, http://flightphp.com/license
                                                                  .____   __ _
     __o__   _______ _ _  _                                     /     /
     \    ~\                                                  /      /
       \     '\                                         ..../      .'
        . ' ' . ~\                                      ' /       /
       .  _    .  ~ \  .+~\~ ~ ' ' " " ' ' ~ - - - - - -''_      /
      .  <#  .  - - -/' . ' \  __                          '~ - \
       .. -           ~-.._ / |__|  ( )  ( )  ( )  0  o    _ _    ~ .
     .-'                                               .- ~    '-.    -.
    <                      . ~ ' ' .             . - ~             ~ -.__~_. _ _
      ~- .       N121PP  .          . . . . ,- ~
            ' ~ - - - - =.   <#>    .         \.._
                        .     ~      ____ _ .. ..  .- .
                         .         '        ~ -.        ~ -.
                           ' . . '               ~ - .       ~-.
                                                       ~ - .      ~ .
                                                              ~ -...0..~. ____
   Cessna 402  (Wings)
   by Dick Williams, rjw1@tyrell.net
*/
$ds = DIRECTORY_SEPARATOR;
define( '__ROOT__', __DIR__ . $ds . '..' );
define( '__APP__', dirname( __DIR__, 1 ) . $ds . 'app' );
define( '__PUBLIC__', dirname( __DIR__, 1 ) . $ds . 'public' );

/** Absolute path to project root */
// Назначить данные шаблона
const SITE_URL = '--== SKELETON ==--';
const LOGO256  = 'logo256.jpg'; //   {$smarty.const.LOGO256}
const LOGO64   = 'logo64.jpg';  //   {$smarty.const.LOGO64}

// require __DIR__ . $ds . '..' . $ds . 'app' . $ds . 'config' . $ds . 'bootstrap.php';
require __APP__ . $ds . 'config' . $ds . 'bootstrap.php';

#####################    /*
#####################    $relaccess = checkLogin();
#####################
#####################    if (! isset($_SESSION['log']) || ! in_array(100, $relaccess)) {
#####################
#####################        if (isset($_POST['user_login']) && isset($_POST['user_pw'])) {
#####################            // regForceSavePassword($_POST['user_login'], $_POST['user_pw']);
#####################
#####################            $hs = verifyPassword($_POST['user_login'], $_POST['user_pw']);
#####################
#####################            if ($hs) {
#####################                $url = set_query('&__tt=');
#####################                // bdump($url);
#####################                Redirect($url);
#####################            }
#####################
#####################            die(ERROR_FORBIDDEN);
#####################        }
#####################
#####################        die(ERROR_FORBIDDEN);
#####################    }
#####################
#####################    //  else {
#####################    //     die(ERROR_FORBIDDEN);
#####################    // }
#####################
#####################    # user logout
#####################    if (isset($_GET['logout'])) {
#####################
#####################        unset($_SESSION['log']);
#####################        unset($_SESSION['pass']);
#####################        unset($_SESSION['current_currency']);
#####################
#####################        // RedirectJavaScript(ADMIN_FILE . '?access_deny=' . SITE_URL);
#####################        // RedirectJavaScript(ADMIN_FILE);
#####################
#####################        if (in_array(100, $relaccess)) {
#####################            Redirect('/');
#####################        } else {
#####################            // Redirect("/index.php?user_details=yes");
#####################            // Redirect('/index.php');
#####################            die(ERROR_FORBIDDEN);
#####################        }
#####################
#####################        die(ERROR_FORBIDDEN);
#####################    }*/

// $tplFetched = Flight::view()->fetch( 'admin.tpl.html' );
// // sdump($app);
// $app->fetch( 'string:The current smarty version is: {$smarty.version}.' );

// echo $tplFetched;