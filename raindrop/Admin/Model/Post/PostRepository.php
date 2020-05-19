<?php

namespace Raindrop\Admin\Model\Post;

use Raindrop\Model;

class PostRepository extends Model{

	public function getAll() {
		$sql = $this->queryBuilder->select()
		                          ->from('post')
		                          ->orderBy('id', 'DESC')
		                          ->sql();

		return $this->db->query($sql);
	}

	public function createPost($params) {
		$post = new Post;
		$post->setTitle($params['title']);
		$post->setContent($params['content']);
		$postId = $post->save();
		return $postId;
	}

	public function updatePost($params) {

		if(isset($params['post_id'])) {
			$post = new Post($params['post_id']);
			$post->setTitle($params['title']);
			$post->setContent($params['content']);
			$post->setStatus($params['status']);
			$post->setType($params['type']);
			$postId = $post->save();
			return $postId;
		}

	}

	public function deletePost($params) {

		if(isset($params['post_id'])) {

			$sql = $this->queryBuilder
				->delete()
				->from('post')
				->where('id', $params['post_id'])
				->sql();

			return $this->db->query($sql);
		}

	}

	public function getPostData($id) {
		$post = new Post($id);

		return $post->findOne();
	}
}