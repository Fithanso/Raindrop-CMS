<?php

namespace Raindrop\Admin\Controller;

class UserController extends AdminController {

	public function listUsers() {
		$this->model = $this->load->model('User');
		$this->load->language('dashboard/main');

		$this->data['users'] = $this->model->user->getAll();


		$this->view->render('users/list_all', $this->data);

	}

	public function listAdmins() {

		$this->model = $this->load->model('User');
		$this->load->language('dashboard/main');

		$this->data['users'] = $this->model->user->getAll('admin');
		$this->view->render('users/list_admins', $this->data);
	}

	public function listBanned() {
		$this->model = $this->load->model('User');
		$this->load->language('dashboard/main');

		$this->data['users'] = $this->model->user->getBannedUsers();

		$this->view->render('users/list_banned', $this->data);
	}

	public function edit($id) {
		$this->model = $this->load->model('User');

		$this->load->language('dashboard/main');

		$user_std = $this->model->user->getUser($id);
		$user = json_decode(json_encode($user_std), true);

		$this->data['unchangeable_properties'] = ['id','hash','date_reg','last_visit'];
		$this->data['changeable_properties'] = [
			'login',
			'email',
			'password',
			['role','select',['admin','user']],
			['banned','bool_select']
		];

		$this->data['user'] = $user[0];

		$this->view->render('users/edit', $this->data);
	}

	public function update() {

		$params = $this->request->post;
		$this->model = $this->load->model('User');
		$userId = $this->model->user->updateUser($params);

	}

	public function ban() {
		$params = $this->request->post;

		$this->model = $this->load->model('User');
		$userId = $this->model->user->banUser($params);

	}

}