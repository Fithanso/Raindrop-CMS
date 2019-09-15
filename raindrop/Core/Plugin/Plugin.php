<?php
namespace Raindrop\Core\Plugin;
use Raindrop\Admin\Model\Plugin\PluginRepository;
use Raindrop\DI\DI;
use Raindrop\Service;
/**
 * Class Plugin
 * @package Engine\Core\Plugin
 */
class Plugin extends Service
{

	public function __construct( DI $di ) {
		parent::__construct( $di );
	}

	/**
	 * @param $directory
	 */
	public function install($directory)
	{
		$this->getLoad()->model('Plugin');
		/** @var PluginRepository $pluginModel */
		$pluginModel = $this->getModel('plugin');
		if (!$pluginModel->isInstallPlugin($directory)) {
			$pluginModel->addPlugin($directory);
		}
	}

	public function uninstall($directory)
	{
		$this->getLoad()->model('Plugin');
		/** @var PluginRepository $pluginModel */
		$pluginModel = $this->getModel('plugin');
		if ($pluginModel->isInstallPlugin($directory)) {
			$pluginModel->deletePlugin($directory);
		}
	}


	public function activate($id, $active)
	{

		$this->getLoad()->model('Plugin');
		/** @var PluginRepository $pluginModel */
		$pluginModel = $this->getModel('plugin');
		$pluginModel->activatePlugin($id, $active);
	}
	/**
	 * @return object
	 */
	public function getActivePlugins()
	{
		$this->getLoad()->model('Plugin');
		/** @var PluginRepository $pluginModel */
		$pluginModel = $this->getModel('plugin');
		return $pluginModel->getActivePlugins();
	}
}