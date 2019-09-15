<?php

namespace Raindrop;

use Raindrop\Core\Template\Setting;

class Load
{
	const MASK_MODEL_ENTITY     = '\%s\Model\%s\%s';
	const MASK_MODEL_REPOSITORY = '\%s\Model\%s\%sRepository';

	const FILE_MASK_LANGUAGE    = 'Language/%s/%s.ini';

	/**
	 * @var \Raindrop\DI\DI
	 */
	public $di;

	public function __construct(DI\DI $di) {
		$this->di = $di;
	}

	/**
	 * @param $modelName
	 * @param bool $modelDir
	 * @return \stdClass
	 */
	public function model($modelName, $modelDir = false, $env = false)
	{

		$modelName  = ucfirst($modelName);
		$modelDir   = $modelDir ? $modelDir : $modelName;
		$env = $env ? $env : ENV;

		if($env == 'Admin') {
			$env = 'Raindrop\Admin';
		}


		$namespaceModel = sprintf(
			self::MASK_MODEL_REPOSITORY,
			$env, $modelDir, $modelName
		);


		$isClassModel = class_exists($namespaceModel);

		if($isClassModel) {

			$modelRegistry = $this->di->get('model') ?: new \stdClass();
			$modelRegistry->{lcfirst($modelName)} = new $namespaceModel($this->di);

			$this->di->set('model', $modelRegistry);
		}


		return $modelRegistry;
	}

	public function language($path) {
		$file = sprintf(
			self::FILE_MASK_LANGUAGE,
			Setting::get('language'),
			$path
		);

		$content = parse_ini_file($file,true);

		//Set to DI

		$languageName = $this->toCamelCase($path);

		$language = $this->di->get('language') ?: new \stdClass();
		$language->{$languageName} = $content;

		$this->di->set('language', $language);

		return $content;
	}

	public function toCamelCase($str) {

		$replace = preg_replace('/[^a-zA-Z0-9]/', ' ', $str);
		$convert = mb_convert_case($replace, MB_CASE_TITLE);
		$result = lcfirst(str_replace(' ', '',$convert));

		return $result;
	}
}