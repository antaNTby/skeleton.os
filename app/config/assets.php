<?php
//assets.php
/*
 .----..---.  .--.  .----.  .---.     .---. .-. .-.  .--.  .---.    .----. .-. .-..----. .----..-.  .-.
{ {__ {_   _}/ {} \ | {}  }{_   _}   {_   _}| {_} | / {} \{_   _}   | {}  }| { } || {}  }| {}  }\ \/ /
.-._} } | | /  /\  \| .-. \  | |       | |  | { } |/  /\  \ | |     | .--' | {_} || .--' | .--'  }  {
`----'  `-' `-'  `-'`-' `-'  `-'       `-'  `-' `-'`-'  `-' `-'     `-'    `-----'`-'    `-'     `--'
*/
// Назначить данные шаблона
const SITE_URL = "--== SKELETON ==--";
const LOGO256  = 'logo256.jpg'; //   {$smarty.const.LOGO256}
const LOGO64   = 'logo64.jpg';  //   {$smarty.const.LOGO64}

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

Flight::view()->assign('LOGO256', LOGO256);
Flight::view()->assign('LOGO64', LOGO64);
Flight::view()->assign('base_url', __PUBLIC__);
Flight::view()->assign('headLinks', $headlinks);

$ACCESS_DENIED_HTML = (checkLogin(0) == [])
? '<div class="alert alert-danger d-flex align-items-center my-5 h2" role="alert">Access Denied - <i class="bi bi-database-slash"></i> - </div>'
: '<div class="alert alert-success d-flex align-items-center my-5 h2" role="alert">Access Granted</div>';

$ERROR_FORBIDDEN_HTML = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/lib/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <title>Login to {$_SITE_URL}</title>
{$bootstrap_icons_css_local}
{$bootstrap_css_local}

</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 my-5">
                <h2 class="text-center mt-5">{$_SITE_URL}</h2>

                <img alt="nix.by" class="d-block mx-auto rounded" src="/lib/{$_LOGO256}" style="background-color:#fff;margin:60px">

                {$ACCESS_DENIED_HTML}

                <form id="aushform" method="post">
                    <div class="mb-3">
                        <label for="user_login" class="form-label">Username</label>
                        <input type="text" class="form-control" id="user_login" name="user_login" value="admin" placeholder="Enter username">
                    </div>
                    <div class="mb-3">
                        <label for="user_pw" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="user_pw" name="user_pw" id="user_pw" placeholder="Enter password">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye-slash" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Sign in</button>
                </form>
            </div>
        </div>
    </div>
    <script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const password = document.getElementById('user_pw');
        const icon = document.getElementById('toggleIcon');
        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            password.type = 'password';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    });
    </script>
</body>

</html>
HTML;

define('ERROR_FORBIDDEN', $ERROR_FORBIDDEN_HTML);
