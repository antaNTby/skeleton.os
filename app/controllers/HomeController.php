<?php

namespace app\controllers;
use flight\Engine;

class HomeController extends BaseController {
	/**
	 * Index
	 *
	 * @return void
	 */
	public function index(): void {
		$admin_main_content_template = 'home.tpl.html';
		$this->app->render( 'index.tpl.html', [
			'admin_main_content_template' => $admin_main_content_template,
			'container_width'             => 'container-xxl',
			'base_url'                    => __PUBLIC__,
		] );

	}
}
