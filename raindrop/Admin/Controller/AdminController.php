<?php

namespace Raindrop\Admin\Controller;

use Raindrop\Controller;

use Raindrop\Core\Auth\Auth;

class AdminController extends Controller {

	/**
	 * @var Auth
	 */
	protected $auth;

	/**
	 * @var array
	 * Variables for rendered page
	 */
	public $data = [];

	/**
	 * AdminController constructor.
	 *
	 * @param \Raindrop\DI\DI $di
	 */
	public function __construct( $di ) {

		parent::__construct( $di );

		$this->auth = new Auth();

		if($this->auth->hashUser() == null) {
			header('Location: /admin/login/');
			exit();
		}

		$this->load->language('dashboard/main');
	}

	public function checkAuthorization() {

		/*if($this->auth->hashUser() !== null) {
			$this->auth->authorize($this->auth->hashUser());
		}

		if(!$this->auth->authorized() ) {
			header('Location: /admin/login/');
			exit();
		}*/
	}

	public function logout() {

			$this->auth->unaAuthorize();
			header('Location: /admin/login/');
			exit();

	}

}