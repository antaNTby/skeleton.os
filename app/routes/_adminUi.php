<?php
// echo '_adminUi.php';
// Маршрут для отображения формы авторизации
// Flight::route( '/login', function () {
// 	echo '<form method="post" action="/login">
//             <label>Логин: <input type="text" name="username"></label><br>
//             <label>Пароль: <input type="password" name="password"></label><br>
//             <button type="submit">Войти</button>
//           </form>';
// } );

Flight::route( '/login', \app\controllers\LoginController::class . '->index' )->setAlias( 'login' );

Flight::route( 'POST /authenticate', \app\controllers\LoginController::class . '->authenticate' )->setAlias( 'authenticate' );

// Flight::route( '/logout', function () {
// 	$session = Flight::session();
// 	$session->clear(); // Очистить все данные сессии
// 	Flight::json( ['message' => 'Успешный выход'] );
// } );