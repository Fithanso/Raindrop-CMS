<?php

namespace Raindrop\Admin\Controller;


class PostController extends AdminController {

	public function listing() {

		$this->model = $this->load->model('Post');

		$this->data['posts'] = $this->model->post->getAll();

		$this->view->render('posts/list', $this->data);
	}

	public function create() {

		$this->model = $this->load->model('Post');

		$this->view->render('posts/create');

	}

	public function edit($id) {

		$this->model = $this->load->model('Post');

		$this->data['baseUrl'] = \Raindrop\Core\Config\Config::item('baseUrl');

		$this->data['post'] = $this->model->post->getPostData($id);

		$this->view->render('posts/edit', $this->data);
	}

	public function add(){

		$this->model = $this->load->model('Post');

		$params = $this->request->post;

		if(isset($params['title'])) {
			$id = $this->model->post->createPost( $params );
			echo $id;
		}

	}

	public function update() {

		$params = $this->request->post;
		$this->model = $this->load->model('Post');

		if(isset($params['title'])) {
			$this->model->post->updatePost($params);
		}

	}

	public function delete(){

		$this->model = $this->load->model('Post');

		$params = $this->request->post;

		$this->model->post->deletePost($params);

	}
}