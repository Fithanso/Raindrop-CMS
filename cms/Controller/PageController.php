<?php

namespace Cms\Controller;

use Raindrop\Admin\Model\Page\PageRepository;
use Cms\Classes\Page;
use Raindrop\Core\Template\Setting;

class_alias('Cms\\Classes\\Page', 'Page');

class PageController extends CmsController {

	const TEMPLATE_PAGE_MASK = 'page-%s';

	/**
	 * @param string|int $slug
	 */
	public function show($slug) {

		$this->model = $this->load->model('Page', false, 'Admin');

		/**
		 * @var PageRepository $pageModel
		 */

		$page = $this->model->page->getPageBySlug($slug);

		if($page === false) {
			header('Location: /');
			exit;
		}

		if($page->status == 'draft') {
			$this->view->render('page404');
		}

		$template = 'page';

		# allows to change templates according to the page's meaning in page's settings
		if($page->type !== 'page') {
			$template = sprintf(self::TEMPLATE_PAGE_MASK, $page->type);
		}

		$data['menu_id'] = Setting::get('index_menu');
		Page::setStore($page);

		$this->view->render($template, $data);
	}
}