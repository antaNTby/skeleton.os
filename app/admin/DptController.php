<?php

namespace app\admin;

use app\controllers;
use flight\Engine;

class DptController extends \app\controllers\BaseController {
	/**
	 * Index
	 *
	 * @return void
	 */
	public function showSub( string $sub = 'menu' ): void {
		$admin_main_content_template = 'admin.tpl.html';
		$sub_content_template        = $sub . '.tpl.html';

		dump( $sub );
		$this->app->render( 'index.tpl.html', [
			'admin_main_content_template' => $admin_main_content_template,
			'sub_content_template'        => $sub_content_template,
			'container_width'             => 'container-xxl',
			'base_url'                    => __PUBLIC__,
		] );

	}
	public function editSub(
		string $sub,
		int    $id
	): void {
		$admin_main_content_template = 'admin.tpl.html';
		$sub_content_template        = $sub . '.tpl.html';

		dump( [$sub, $id] );

		$this->app->render( 'index.tpl.html', [
			'admin_main_content_template' => $admin_main_content_template,
			'sub_content_template'        => $sub_content_template,
			'container_width'             => 'container-xxl',
			'base_url'                    => __PUBLIC__,
		] );

	}
}
