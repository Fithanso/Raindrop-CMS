<?php

namespace Raindrop\Admin\Controller;

class PageController extends AdminController {

	public function listing() {

		$this->model = $this->load->model('Page');

		$this->data['pages'] = $this->model->page->getPages();
		$this->data['lang'] = $this->di->get('lang');

		$this->view->render('pages/list', $this->data);
	}

	public function create() {

		$this->model = $this->load->model('Page');

		$this->view->render('pages/create');

	}

	public function edit($id) {

		$this->model = $this->load->model('Page');

		$this->data['baseUrl'] = \Raindrop\Core\Config\Config::item('baseUrl');

		$this->data['page'] = $this->model->page->getPageData($id);

		$this->view->render('pages/edit', $this->data);
	}

	public function add(){

		$this->model = $this->load->model('Page');

		$params = $this->request->post;


		if(isset($params['title'])) {
			$pageId = $this->model->page->createPage($params);
			echo $pageId;
		}

	}

	public function update() {

		$params = $this->request->post;
		$this->model = $this->load->model('Page');

		if(isset($params['title'])) {
			$pageId = $this->model->page->updatePage($params);
		}
	}

	public function delete(){

		$this->model = $this->load->model('Page');

		$params = $this->request->post;


		if(isset($params['page_id'])) {
			$pageId = $this->model->page->deletePage($params);
			echo $pageId;
		}

	}
}