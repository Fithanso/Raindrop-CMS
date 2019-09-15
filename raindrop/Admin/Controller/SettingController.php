<?php

namespace Raindrop\Admin\Controller;

use Raindrop\Core\Template\Theme;

class SettingController extends AdminController
{
    public function general()
    {

        $this->model = $this->load->model('Setting');
        $this->data['settings']  = $this->model->setting->getSettings();

        $this->data['languages'] = languages();

        $this->view->render('setting/general', $this->data);
    }

    public function menus()
    {
    	$this->model = new \stdClass();
        $this->model->menu = $this->load->model('Menu', false, 'Cms');
	    $this->model->menuItem = $this->load->model('MenuItem', false, 'Cms');

	    if(isset($this->request->get['menu_id'])) {
		    $this->data['menuId']   = $this->request->get['menu_id'];
		    $this->data['editMenu'] = $this->model->menu->menuItem->getItems($this->data['menuId']);
	    }
	    //print_r($this->model['menu']);
        $this->data['menus'] = $this->model->menu->menu->getList();
        $this->view->render('setting/menus', $this->data);
    }

    public function themes() {

    	$this->data['themes'] = getThemes();
    	$this->data['activeTheme'] = \Setting::get('active_theme');


    	$this->view->render('setting/themes', $this->data);
    }

    public function ajaxMenuAdd()
    {
        $params = $this->request->post;

        $this->model = $this->load->model('Menu', false, 'Cms');

        if (isset($params['name']) && strlen($params['name']) > 0) {
            $addMenu = $this->model->menu->add($params);

            echo $addMenu;
        }
    }

    public function ajaxMenuAddItem()
    {
        $params = $this->request->post;

        $this->model = $this->load->model('MenuItem', false, 'Cms');

        if (isset($params['menu_id']) && strlen($params['menu_id']) > 0) {
            $id = $this->model->menuItem->add($params);

            $item = new \stdClass;
            $item->id   = $id;
            $item->name = \Cms\Model\MenuItem\MenuItemRepository::NEW_MENU_ITEM_NAME;
            $item->link = '#';

            Theme::block('setting/menu_item', [
                'item' => $item
            ]);
        }
    }

    public function ajaxMenuSortItems()
    {
        $params = $this->request->post;

        $this->model = $this->load->model('MenuItem', false, 'Cms');

        if (isset($params['data']) && !empty($params['data'])) {
            $sortItem = $this->model->menuItem->sort($params);
        }
    }

    public function ajaxMenuUpdateItem() {

    	$params = $this->request->post;

    	$this->model = $this->load->model('MenuItem', false, 'Cms');

    	if(isset($params['item_id']) && strlen($params['item_id']) > 0) {
    		$this->model->menuItem->update($params);
	    }
    }

    public function ajaxMenuRemoveItem()
    {
        $params = $this->request->post;

	    $this->model = $this->load->model('MenuItem', false, 'Cms');

        if (isset($params['item_id']) && strlen($params['item_id']) > 0) {
            $removeItem = $this->model->menuItem->remove($params['item_id']);

            //echo $removeItem;
        }
    }

    public function updateSetting()
    {
	    $this->model = $this->load->model('Setting');

        $params = $this->request->post;

        $this->model->setting->update($params);
    }

    public function activateTheme() {

    	$params = $this->request->post;

    	$this->model = $this->load->model('Setting');

    	$this->model->setting->updateActiveTheme($params['theme']);
    }
}