<?php
/**
 * Created by PhpStorm.
 * User: Fithanso
 * Date: 14.05.2019
 * Time: 11:42
 */

namespace Raindrop\Admin\Controller;


class DashboardController extends AdminController {

	public function index() {
		$userModel = $this->load->model('User');
		$phpmailer = $this->di->get('phpmailer');

		$this->load->language('dashboard/main');


		$this->view->render('dashboard');

	}

}