<?php

namespace Raindrop\Admin\Controller;


class PluginController extends AdminController {

	public function listPlugins() {

		$this->model = $this->load->model('Plugin');

		$installedPlugins = $this->model->plugin->getPlugins();
		$plugins = getPlugins();

		foreach($installedPlugins as $key => $plugin) {//сделать директорию плагина ключом в массиве
			$installedPlugins[$plugin->directory] = $plugin;
			unset($installedPlugins[$key]);
		}

		foreach($plugins as $key => $plugin) {
			//если в установленных есть плагин


			if(isset($installedPlugins[$key])) {
				$plugins[$key]['is_install'] = true;
				$plugins[$key]['is_active'] = $installedPlugins[$key]->is_active;
				$plugins[$key]['plugin_id'] = $installedPlugins[$key]->id;
			}else{
				$plugins[$key]['is_install'] = false;
				$plugins[$key]['is_active'] = false;
				$plugins[$key]['plugin_id'] = '0';
			}
		}


		/*if(!empty($installedPlugins)) {//проверить, есть ли в базе вообще плагины
			foreach($installedPlugins as $plugin) {

				$plugins[$plugin->directory]['is_active'] = $plugin->is_active;
				$plugins[$plugin->directory]['is_install'] = true;
				$plugins[$plugin->directory]['plugin_id'] = $plugin->id;
			}
		}else{
			//no plugins are added
		}*/


		$this->data['plugins'] = $plugins;

		$this->view->render('plugins/list', $this->data);
	}

	public function ajaxInstall() {
		$directory = $this->getRequest()->post('directory');

		if($directory !== null) {
			$this->getPlugin()->install($directory);
		}
	}

	public function ajaxUninstall() {
		$directory = $this->getRequest()->post('directory');
		if($directory !== null) {
			$this->getPlugin()->uninstall($directory);
		}
	}

	public function ajaxActivate() {
		$pluginId = $this->getRequest()->post('id');

		$active = $this->getRequest()->post('active');

		if($pluginId !== null) {
			$this->getPlugin()->activate($pluginId, $active);

		}
	}


}