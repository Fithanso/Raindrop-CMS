<?php

namespace Cms\Controller;

use Raindrop\Admin\Model\Post\PostRepository;
use Cms\Classes\Post;
use Raindrop\Core\Template\Setting;

class_alias('Cms\\Classes\\Post', 'Post');

class PostController extends CmsController {
	const TEMPLATE_PAGE_MASK = 'post-%s';

	/**
	 * @param string|int $id
	 */
	public function show($id) {

		$this->model = $this->load->model('Post', false, 'Admin');

		/**
		 * @var PostRepository $postModel
		 */

		$post = $this->model->post->getPostData($id);

		if($post === false) {
			header('Location: /');
			exit;
		}

		if($post->status == 'draft') {
			$this->view->render('page404');
		}

		$template = 'post';

		$data['menu_id'] = Setting::get('index_menu');
		Post::setStore($post);

		$this->view->render($template, $data);
	}
}