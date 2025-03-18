<?php
//assets.php
/*
 .----..---.  .--.  .----.  .---.     .---. .-. .-.  .--.  .---.    .----. .-. .-..----. .----..-.  .-.
{ {__ {_   _}/ {} \ | {}  }{_   _}   {_   _}| {_} | / {} \{_   _}   | {}  }| { } || {}  }| {}  }\ \/ /
.-._} } | | /  /\  \| .-. \  | |       | |  | { } |/  /\  \ | |     | .--' | {_} || .--' | .--'  }  {
`----'  `-' `-'  `-'`-' `-'  `-'       `-'  `-' `-'`-'  `-' `-'     `-'    `-----'`-'    `-'     `--'
*/

$_SITE_URL = SITE_URL;
$_LOGO256  = LOGO256;
$_LOGO64   = LOGO64;

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

$datatables_css_local = '<link rel="stylesheet" type="text/css" href="/lib/datatables/datatables.css">';

$uiAdmin_css = '<link rel="stylesheet" type="text/css" href="/lib/datatables/datatables.css">
    <link rel="stylesheet" type="text/css" href="/lib/uiAdmin.css">';

$headlinks = [
	'bootstrap_icons_css_local' => $bootstrap_icons_css_local,
	'bootstrap_css_local'       => $bootstrap_css_local,
	'bootstrap_icons_css_CDN'   => $bootstrap_icons_css_CDN,
	'bootstrap_css_CDN'         => $bootstrap_css_CDN,
	'datatables_css_local'      => $datatables_css_local,
	'uiAdmin_css'               => $uiAdmin_css,
];

Flight::view()->assign( 'LOGO256', LOGO256 );
Flight::view()->assign( 'LOGO64', LOGO64 );
Flight::view()->assign( 'base_url', __PUBLIC__ );
Flight::view()->assign( 'headLinks', $headlinks );
