<?php

namespace Raindrop\Admin\Controller;

use Raindrop\Core\Auth\Auth;

class PreLaunchController extends AdminController {

	/**
	 * CMS can ve activated only through domain's name url. (there must be no 'admin' in url)
	 */
	/*public function preLaunch() {
		$vars = [];
		$this->view->render('welcome_page',$vars,true);

		$db = $this->di->get('db');

		if(isset($_POST['email']) && isset($_POST['password'])) {

			$email = $_POST['email'];
			$password = Auth::encryptPassword($_POST['password']);

			$sql_queries['createTableMenu'] = 'CREATE TABLE menu(id INT PRIMARY KEY AUTO_INCREMENT,name VARCHAR (100) NOT NULL);';
			$sql_queries['menuChSet'] = 'ALTER TABLE menu CHARACTER SET utf8_general_ci;';

			$sql_queries['createTableMenuItem'] = 'CREATE TABLE menu_item(id INT PRIMARY KEY AUTO_INCREMENT, menu_id INT DEFAULT "0",name VARCHAR(255),parent TINYINT(1) DEFAULT "0",position INT(5) DEFAULT "999",link VARCHAR(255) DEFAULT "#");';
			$sql_queries['menuItemChSet'] = 'ALTER TABLE menu_item CHARACTER SET utf8_general_ci;';

			$sql_queries['createTablePage'] = 'CREATE TABLE page(id INT PRIMARY KEY AUTO_INCREMENT,title VARCHAR (255),content TEXT, slug VARCHAR(255),type VARCHAR(20) DEFAULT "page",status VARCHAR(50) DEFAULT "publish",date TIMESTAMP DEFAULT CURRENT_TIMESTAMP);';
			$sql_queries['pageChSet'] = 'ALTER TABLE page CHARACTER SET utf8_general_ci;';

			$sql_queries['createTablePlugin'] = 'CREATE TABLE plugin(id INT PRIMARY KEY AUTO_INCREMENT,directory VARCHAR (100) NOT NULL,is_active TINYINT(1) DEFAULT "0");';
			$sql_queries['pluginChSet'] = 'ALTER TABLE plugin CHARACTER SET utf8_general_ci;';

			$sql_queries['createTablePost'] = 'CREATE TABLE post(id INT PRIMARY KEY AUTO_INCREMENT,title VARCHAR (255),content TEXT,status VARCHAR(50) DEFAULT "publish",date TIMESTAMP DEFAULT CURRENT_TIMESTAMP);';
			$sql_queries['postChSet'] = 'ALTER TABLE post CHARACTER SET utf8_general_ci;';

			$sql_queries['createTableSetting'] = 'CREATE TABLE setting(id INT PRIMARY KEY AUTO_INCREMENT,name VARCHAR (100),key_field VARCHAR(100), value VARCHAR(100), field_type VARCHAR(25), section VARCHAR(100) DEFAULT "general", description TEXT);';
			$sql_queries['settingChSet'] = 'ALTER TABLE setting CHARACTER SET utf8_general_ci;';

			$sql_queries['createTableUser'] = 'CREATE TABLE user(id INT PRIMARY KEY AUTO_INCREMENT,email VARCHAR (100),password VARCHAR(200), role ENUM(\'admin\', \'moderator\', \'user\'), hash VARCHAR(100), date_reg DATETIME DEFAULT CURRENT_TIMESTAMP);';
			$sql_queries['userChSet'] = 'ALTER TABLE user CHARACTER SET utf8_general_ci;';


			$sql_queries['insSetNameSite'] = 'INSERT INTO `setting`(`name`, `key_field`, `value`) VALUES ("Site name","site_name","Raindrop CMS")';
			$sql_queries['insSetDescription'] = 'INSERT INTO `setting`(`name`, `key_field`, `value`) VALUES ("Description","description","")';
			$sql_queries['insSetAdminEmail'] = 'INSERT INTO `setting`(`name`, `key_field`, `value`) VALUES ("Admin email","admin_email","admin@admin.com")';
			$sql_queries['insSetLang'] = 'INSERT INTO `setting`(`name`, `key_field`, `value`) VALUES ("Language","language","english")';
			$sql_queries['insSetActTheme'] = 'INSERT INTO `setting`(`name`, `key_field`, `value`, `section`) VALUES ("Active theme","active_theme","default","theme")';
			$sql_queries['insSetDDLink'] = 'INSERT INTO `setting`(`name`, `key_field`, `value`, `field_type`, `description`) VALUES ("Display dashboard link","dashboard_link","0","binary_choice","Shows a dashboard link on index page")';


			$sql_queries['insertAdmin'] = 'INSERT INTO `user`(`email`, `password`, `role`, `hash`) VALUES ("'.$email.'","'.$password.'","admin","123")';


			foreach($sql_queries as $name => $query) {
				$db->simpleQuery($query);

			}

			file_put_contents(ROOT_DIR.'/../sys_data.ini', 'cms is activated');


		}


	}*/


}