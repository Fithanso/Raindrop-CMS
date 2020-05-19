<?php


namespace Plugin\Admin\LiveTest;

use Cms\Controller\CmsController;


class LiveTestController extends CmsController {
	public function test(){
		print_r('test plugin');
	}
}