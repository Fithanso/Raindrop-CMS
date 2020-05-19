# Raindrop-CMS
CMS can be activated by going to the home page (http://site_name).
A welcome page will appear. Insert e-mail, nickname and password that will be used by administrator and hit the button.
SQL queries will be configured and applied with settings and admin's data.
Make sure that file sys_data.ini must be empty before the system launch.
Any questions: fms160602@gmail.com




A little bit of explanation

Posts and pages are different models with different intended usage, however, they can be edited the same way.
To access models both in users' (ENV = 'Cms') and admins's (ENV = 'Admin') you should have both Model's classes
placed in both directories: raindrop/Admin/Models and cms/Models. 
 
Plugins

Plugins should  be put in content/ENV/plugins. Namespace should be: 'Plugin\ENV\\[plugin_name]'. ENV means environment. This constant is defined in index.php
(there are two of them - one in root, one in raindrop/Admin)
You can locate controller in the same folder. If you want to add a new route through your plugin, do the same as in Routes.php,
but put '1' (as integer) as last parameter of add() method.
Plugins are initialised according to ENV constant set. You should put your plugin to the right directory (plugins/Admin or plugins/Cms) according to
what part of web-site is going to be reworked.