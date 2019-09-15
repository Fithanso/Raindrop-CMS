<?php

namespace Cms\Controller;

class ErrorController extends CmsController {

	public function page404() {
		$this->view->render('page404');
	}
}