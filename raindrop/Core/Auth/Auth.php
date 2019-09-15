<?php

namespace Raindrop\Core\Auth;

use Raindrop\Helper\Cookie;

use Raindrop\Core\Auth\AuthInterface;

class Auth implements AuthInterface {

	public $authorized = false;//protected&&
	protected $hash_user;

	/**
	 *
	 * @return bool
	 */
	public function authorized() {
		return $this->authorized;
	}

	/**
	 * @return mixed
	 */
	public function hashUser() {

		return Cookie::get('auth_user');
	}

	/**
	 * User authorization
	 * @param $user
	 */
	public function authorize($user) {
		Cookie::set('auth_authorized', true);
		Cookie::set('auth_user', $user);
	}

	/**
	 * User unauthorization
	 * @param $user
	 */
	public function unaAuthorize($user = []) {
		Cookie::delete('auth_authorized');
		Cookie::delete('auth_user');

	}


	/**
	 * Generates a new random password salt
	 * @return string
	 */
	public static function salt() {

		return (string) rand(10000000, 99999999);
	}

	public static function encryptPassword($password, $salt = '') {
		return hash('md5', $password . $salt);
	}
}