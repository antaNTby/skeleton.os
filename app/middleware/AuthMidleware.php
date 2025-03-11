<?php
//AuthMidleware.php

class AuthMiddleware {
	public function before( $params ) {
		$authorization = Flight::request()->headers['Authorization'];
		if ( empty( $authorization ) ) {
			Flight::jsonHalt( ['error' => 'You must be logged in to access this page.'], 403 );
			// or
			Flight::json( ['error' => 'You must be logged in to access this page.'], 403 );
			exit;
			// or
			Flight::halt( 403, json_encode( ['error' => 'You must be logged in to access this page.'] );
			}
		}
	}