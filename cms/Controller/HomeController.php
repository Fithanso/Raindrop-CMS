<?php

namespace Cms\Controller;

class HomeController extends CmsController {

	public function index() {

		$this->model = $this->load->model('Post', false, 'Admin');
		$posts = $this->model->post->getPosts();
		$data['posts'] = $posts;

		$this->view->render('index', $data);
	}

	public function user($id) {
		echo 'user '.$id;
	}
}