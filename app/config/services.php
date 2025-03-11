<?php

use flight\Engine;

/**
 * @var array $config This comes from the returned array at the bottom of the config.php file
 * @var Engine $app
 */

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

function checkLogin($showDump = true)
{
    $roles   = [];
    $message = '';

    // Look for the user in the database
    if (isset($_SESSION['log'])) {

        $db = MysqliDb::getInstance();
        $db->where('Login', trim($_SESSION['log']));
        $row = $db->getOne('customers', 'cust_password, actions');

        if (! $row) {
            $message .= 'User not found. ';
        }
        if (! isset($_SESSION['pass'])) {
            $message .= 'Password is not saved. ';
        }
        if ($_SESSION['pass'] !== $row['cust_password']) {
            $message .= 'Password does not match. ';
        }

        if ($message !== '') {
            unset($_SESSION['log']);
            unset($_SESSION['pass']);
            unset($_SESSION['current_currency']);
        } else {
            try {
                $roles = unserialize($row['actions']);
                unset($row);
            } catch (Exception $e) {
                $roles = [];
            }
        }
    } else {
        $message .= 'User is not logged in. ';
    }

    if ($showDump && $message !== '') {
        bdump($message);
    }

    return $roles;
}
