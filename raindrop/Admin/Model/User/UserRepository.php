<?php

namespace  Raindrop\Admin\Model\User;

use Raindrop\Model;

class UserRepository extends Model{

	public function getUser($id) {
		$sql = $this->queryBuilder->select()
		                          ->from('user')
		                          ->where('id',$id)
		                          ->sql();

		return $this->db->query($sql);
	}

	public function getAll($role = 'user', $banned = '0') {
		$sql = $this->queryBuilder->select()
			->from('user')
			->where('role',$role)
			->where('banned',$banned)
			->orderBy('id', 'DESC')
			->sql();

		return $this->db->query($sql);
	}

	public function getBannedUsers() {
		$sql = $this->queryBuilder->select()
		                          ->from('user')
		                          ->where('banned','1')
		                          ->orderBy('id', 'DESC')
		                          ->sql();

		return $this->db->query($sql);
	}

	public function addUser($email, $login, $password, $role, $hash) {
		$user = new User();
		$user->setEmail($email);
		$user->setLogin($login);
		$user->setPassword($password);
		$user->setRole($role);
		$user->setHash($hash);
		$user->save();
	}

	public function updateUser($params) {

		if(isset($params['id'])) {

			$user = new User($params['id']);

			$user->setId($params['id']);
			$user->setLogin($params['login']);
			$user->setEmail($params['email']);
			$user->setPassword($params['password']);
			$user->setRole($params['role']);
			$user->setDateReg($params['date_reg']);
			$user->setHash($params['hash']);
			$user->setLastVisit($params['last_visit']);
			$user->setBanned($params['banned']);

			$userId = $user->save();

			return $userId;
		}

	}

	public function banUser($params) {
		$id = key($params);

		$user = new User($id);

		$user->setBanned('1');

		$userId = $user->save();


	}

	public function deleteUser($params) {

		$sql = $this->queryBuilder
				->delete()
				->from('page')
				->where('id', $params['page_id'])
				->sql();

		return $this->db->query($sql);
	}
}