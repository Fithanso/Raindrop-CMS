<?php

namespace Raindrop\Admin\Controller;

class ErrorController extends AdminController {

	public function page404() {
		$this->view->render('page404');
	}
}