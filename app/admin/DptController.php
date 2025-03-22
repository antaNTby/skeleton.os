<?php

namespace app\admin;
use flight\Engine;

class HomeController extends BaseController {
	/**
	 * Index
	 *
	 * @return void
	 */
	public function showSub( $sub ): void {
		$admin_main_content_template = 'admin.tpl.html';
		$sub_content_template        = $sub . '.tpl.html';
		$this->app->render( 'index.tpl.html', [
			'admin_main_content_template' => $admin_main_content_template,
			'sub_content_template'        => $sub_content_template,
			'container_width'             => 'container-xxl',
			'base_url'                    => __PUBLIC__,
		] );

	}
}
