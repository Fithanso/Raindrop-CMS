<?php

namespace Raindrop\Core\Template;

use Raindrop\DI\DI;

class View {

	public $di;

	/**
	 * @var \Raindrop\Core\Template\Theme
	 */
	protected $theme;

	/**
	 * @var Setting
	 */
	protected $setting;

	/**
	 * @var Menu
	 */
	protected $menu;

	/**
	 * View constructor.
	 */
	public function __construct($di) {

		$this->di = $di;
		$this->theme = new Theme();
		$this->setting = new Setting($di);
		$this->menu = new Menu($di);

	}

	/**
	 * If you need to render one of cms's integrated pages, put $useInbuiltView to true
	 * @param $template
	 * @param array $vars
	 * @param bool $useInbuiltView
	 *
	 * @throws \Exception
	 */
	public function render($template, $vars=[], $useInbuiltView = false) {

		$functions =  Theme::getThemePath() . '/functions.php';

		if(file_exists($functions)) {
			include_once $functions;
		}

		if($useInbuiltView) {
			$templatePath = $this->getSystemViewsPath($template, ENV);
		}else{
			$templatePath = $this->getTemplatePath($template, ENV);
		}

		if(!is_file($templatePath)) {
			throw new \InvalidArgumentException(
				sprintf('Template "%s" not found in "%s"',$template,$templatePath)
			);
		}

		$vars['lang'] = $this->di->get('language');

		$this->theme->setData($vars);//ставим переменные для вложенных элементов
		extract($vars);//ставим переменные для главного шаблона

		ob_start();
		ob_implicit_flush(0);//отключить принудительную очистку

		try{

			require $templatePath;
		}catch (\Exception $e) {
			ob_end_clean();//очистить и отключить буфер
			throw $e;
		}

		echo ob_get_clean();
	}


	/**
	 * @param $template
	 * @param null $env
	 *
	 * @return string
	 */
	private function getTemplatePath($template, $env = null) {

		if($env == 'Cms') {
			$theme = \Setting::get('active_theme');

			if($theme == '') {

				$theme = \Raindrop\Core\Config\Config::item('defaultTheme');
			}
			return ROOT_DIR . '/content/themes/' . $theme . '/' . $template . '.php';
		}

		return path('view') . '/' . $template . '.php';
	}


	private function getSystemViewsPath($template, $env = null) {

		if($env == 'Admin') {
			return ROOT_DIR . '/../Views/' . $template . '.php';
		}
		return ROOT_DIR . '/raindrop/Views/' . $template . '.php';
	}

}