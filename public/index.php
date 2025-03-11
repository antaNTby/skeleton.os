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
require __DIR__ . $ds . '..' . $ds . 'app' . $ds . 'config' . $ds . 'bootstrap.php';

// sdump( $app );
// dump( $app );

// Назначить данные шаблона

$bootstrap_icons_css_local = <<<HTML
<link rel="stylesheet" href="/lib/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css">
HTML;
$bootstrap_css_local = <<<HTML
<link rel="stylesheet" href="/lib/bootstrap-5.3.3-dist/css/bootstrap.min.css">
HTML;

$bootstrap_icons_css_CDN = <<<HTML
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
HTML;
$bootstrap_css_CDN = <<<HTML
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
HTML;

Flight::view()->assign( 'headLinks', [
	'bootstrap_icons_css_local' => $bootstrap_icons_css_local,
	'bootstrap_css_local'       => $bootstrap_css_local,
	'bootstrap_icons_css_CDN'   => $bootstrap_icons_css_CDN,
	'bootstrap_css_CDN'         => $bootstrap_css_CDN,
] );

Flight::view()->assign( 'name', 'Bob' );

// Отобразить шаблон
Flight::view()->display( 'hello.tpl.html' );