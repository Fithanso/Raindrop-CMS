<?php

namespace Raindrop\Admin\Controller;


class PostController extends AdminController {

	public function listing() {

		$this->model = $this->load->model('Post');

		$this->data['posts'] = $this->model->post->getPosts();

		$this->view->render('posts/list', $this->data);
	}

	public function create() {

		$this->model = $this->load->model('Post');

		$this->view->render('posts/create');

	}

	public function edit($id) {

		$this->model = $this->load->model('Post');

		$this->data['post'] = $this->model->post->getPostData($id);

		$this->view->render('posts/edit', $this->data);
	}

	public function add(){

		$this->model = $this->load->model('Post');

		$params = $this->request->post;


		if(isset($params['title'])) {
			$pageId = $this->model->post->createPost($params);
			echo $pageId;
		}

	}

	public function update() {

		$params = $this->request->post;
		$this->model = $this->load->model('Post');

		if(isset($params['title'])) {
			$pageId = $this->model->post->updatePost($params);
			echo $pageId;
		}
	}
}