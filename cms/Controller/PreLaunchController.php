<?php

namespace Cms\Controller;

use Raindrop\Core\Auth\Auth;
use Raindrop\Helper\Common;

/**
 * Class PreLaunchController is used to apply some sql queries and configure system
 * @package Cms\Controller
 */
class PreLaunchController extends CmsController {

	public $auth;

	public function preLaunch() {

		$this->auth = new Auth();
		$vars = [];

		if(empty($_POST)){
			$this->view->render('welcome_page',$vars,true);
		}

		if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['login'])) {

			$email = $_POST['email'];
			$password= $_POST['password'];
			$login = $_POST['login'];
			$hash = md5('1' . $email . $password . $this->auth->salt());

			$this->preLaunchSql($email, $password, $login, $hash);

			$email_body = 'CMS was successfully activated!<br>Your login: '.$login.'<br>Email: '.$email.'<br>Password: '.$password;

			$emails[] = $email;

			Common::sendMail($emails, $email_body, 'Account activated');

			$this->auth->authorize($hash);

			$this->applyActivation();

		}

	}

	/**
	 * Function changes 'active' setting in Admin/Config/main.json to 1(true)
	 */
	private function applyActivation() {
		$path = __DIR__.'/../Config/main.json';
		$json = file_get_contents($path);
		$d = json_decode($json);
		$items = json_decode(json_encode($d), true);
		$items['active'] = '1';
		$newJson = json_encode($items);
		file_put_contents($path, $newJson);
	}

	public function preLaunchSql($email, $password, $login, $hash) {

		$db = $this->di->get('db');

		$enc_password = Auth::encryptPassword($password);


		$sql_queries['createTableMenu'] = 'CREATE TABLE menu(id INT PRIMARY KEY AUTO_INCREMENT,name VARCHAR (100) NOT NULL);';
		$sql_queries['menuChSet'] = 'ALTER TABLE menu CHARACTER SET utf8_general_ci;';

		$sql_queries['createTableMenuItem'] = 'CREATE TABLE menu_item(id INT PRIMARY KEY AUTO_INCREMENT, menu_id INT DEFAULT "0",name VARCHAR(255),parent TINYINT(1) DEFAULT "0",position INT(5) DEFAULT "999",link VARCHAR(255) DEFAULT "#");';
		$sql_queries['menuItemChSet'] = 'ALTER TABLE menu_item CHARACTER SET utf8_general_ci;';

		$sql_queries['createTablePage'] = 'CREATE TABLE page(id INT PRIMARY KEY AUTO_INCREMENT,title VARCHAR (255),content TEXT, slug VARCHAR(255),type VARCHAR(20) DEFAULT "page",status VARCHAR(50) DEFAULT "publish",date TIMESTAMP DEFAULT CURRENT_TIMESTAMP);';
		$sql_queries['pageChSet'] = 'ALTER TABLE page CHARACTER SET utf8_general_ci;';

		$sql_queries['createTablePlugin'] = 'CREATE TABLE plugin(id INT PRIMARY KEY AUTO_INCREMENT,directory VARCHAR (100) NOT NULL,is_active TINYINT(1) DEFAULT "0");';
		$sql_queries['pluginChSet'] = 'ALTER TABLE plugin CHARACTER SET utf8_general_ci;';

		$sql_queries['createTablePost'] = 'CREATE TABLE post(id INT PRIMARY KEY AUTO_INCREMENT,title VARCHAR (255),content TEXT, type VARCHAR(20) DEFAULT "post", status VARCHAR(50) DEFAULT "publish",date TIMESTAMP DEFAULT CURRENT_TIMESTAMP);';
		$sql_queries['postChSet'] = 'ALTER TABLE post CHARACTER SET utf8_general_ci;';

		$sql_queries['createTableSetting'] = 'CREATE TABLE setting(id INT PRIMARY KEY AUTO_INCREMENT, key_field VARCHAR(100), value VARCHAR(100), field_type VARCHAR(25), section VARCHAR(150) DEFAULT "general", description BOOLEAN);';
		$sql_queries['settingChSet'] = 'ALTER TABLE setting CHARACTER SET utf8_general_ci;';

		$sql_queries['createTableUser'] = 'CREATE TABLE user(id INT PRIMARY KEY AUTO_INCREMENT,login VARCHAR (50) ,email VARCHAR (100),password VARCHAR(200), role ENUM(\'admin\', \'moderator\', \'user\'), hash VARCHAR(100), date_reg DATETIME DEFAULT CURRENT_TIMESTAMP, last_visit DATETIME DEFAULT CURRENT_TIMESTAMP, banned TINYINT (1) DEFAULT "0");';
		$sql_queries['userChSet'] = 'ALTER TABLE user CHARACTER SET utf8_general_ci;';


		$sql_queries['insSetNameSite'] = 'INSERT INTO `setting`(`key_field`, `value`) VALUES ("site_name","Raindrop CMS")';
		$sql_queries['insSetDescription'] = 'INSERT INTO `setting`(`key_field`, `value`) VALUES ("description","")';
		$sql_queries['insSetNotifyEmail'] = 'INSERT INTO `setting`(`key_field`, `value`) VALUES ("email_notifications","'.$email.'")';
		$sql_queries['insSetLang'] = 'INSERT INTO `setting`(`key_field`, `value`) VALUES ("language","english")';
		$sql_queries['insSetActTheme'] = 'INSERT INTO `setting`(`key_field`, `value`, `section`) VALUES ("active_theme","default","theme")';
		$sql_queries['insSetDDLink'] = 'INSERT INTO `setting`(`key_field`, `value`, `field_type`, `description`) VALUES ("dashboard_link","1","binary_choice","1")';
		$sql_queries['insSetIndexMenu'] = 'INSERT INTO `setting`(`key_field`, `value`, `description`) VALUES ("index_menu","1", "1")';


		$sql_queries['insertAdmin'] = 'INSERT INTO `user`(`email`, `password`, `login`, `role`, `hash`) VALUES ("'.$email.'","'.$enc_password.'","'.$login.'","admin","'.$hash.'")';

		foreach($sql_queries as $name => $query) {
			$db->simpleQuery($query);
		}
	}

}