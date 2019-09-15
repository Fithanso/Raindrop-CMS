<?php

namespace Raindrop\Admin\Model\Page;

use Raindrop\Model;

class PageRepository extends Model{

	public function getPages() {
		$sql = $this->queryBuilder->select()
			->from('page')
			->orderBy('id', 'DESC')
			->sql();

		return $this->db->query($sql);
	}

	public function createPage($params) {

		$page = new Page;

		$page->setTitle($params['title']);
		$page->setContent($params['content']);
		$page->setSlug(\Raindrop\Helper\Text::transliteration($params['title']));

		$pageId = $page->save();

		return $pageId;
	}

	public function updatePage($params) {

		if(isset($params['page_id'])) {
			$page = new Page($params['page_id']);
			$page->setTitle($params['title']);
			$page->setContent($params['content']);
			if($params['status'] == 'draft') {
				$page->setType('basic');
			}else{
				$page->setType($params['type']);
			}
			$page->setStatus($params['status']);

			$pageId = $page->save();
			return $pageId;
		}

	}

	public function deletePage($params) {

		if(isset($params['page_id'])) {

			$sql = $this->queryBuilder
				->delete()
				->from('page')
				->where('id', $params['page_id'])
				->sql();

			return $this->db->query($sql);
		}

	}

	public function getPageData($id) {
		$page = new Page($id);

		return $page->findOne();
	}

	/**
	 * @param string $slug
	 *
	 * @return object|bool
	 */
	public function getPageBySlug($slug) {
		$sql = $this->queryBuilder
			->select()
			->from('page')
			->where('slug', $slug)
			->limit(1)
			->sql();

		$result = $this->db->query($sql, $this->queryBuilder->values);

		return isset($result[0]) ? $result[0] : false;

	}
}