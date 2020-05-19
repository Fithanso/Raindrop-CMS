<?php

namespace Cms\Controller;

use Raindrop\Core\Template\Setting;

class HomeController extends CmsController {

	public function index() {
		if(isset($this->request->get['p'])) {
			$data['paginator_offset'] = $this->request->get['p'];
		}else{
			$data['paginator_offset'] = 1;
		}

		$this->model = $this->load->model('Post', false, 'Admin');
		$posts = $this->model->post->getAll();
		$data['posts'] = $posts;
		$data['menu_id'] = Setting::get('index_menu');
		$data['di'] = $this->di;

		$this->view->render('index', $data);
	}

	public function user($id) {
		echo 'user '.$id;
	}
}