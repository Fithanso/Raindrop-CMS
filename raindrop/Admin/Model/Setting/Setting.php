<?php

namespace Raindrop\Admin\Model\Setting;

use Raindrop\Core\Database\ActiveRecord;

class Setting {

	use ActiveRecord;

	protected $table = 'setting';

	public $id;

	public $name;

	public $key_field;

	public $value;

	public $setting;

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param mixed $value
	 */
	public function setValue( $value ) {
		$this->value = $value;
	}

	/**
	 * @return mixed
	 */
	public function getKeyField() {
		return $this->key_field;
	}

	/**
	 * @param mixed $key_field
	 */
	public function setKeyField( $key_field ) {
		$this->key_field = $key_field;
	}

	/**
	 * @return mixed
	 */
	public function getSetting() {
		return $this->setting;
	}

	/**
	 * @param mixed $setting
	 */
	public function setSetting( $setting ) {
		$this->setting = $setting;
	}

}