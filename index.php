<?php
ini_set("display_errors",1);
error_reporting(E_ALL);

define('ROOT_DIR', __DIR__);//корневая директория, т.е. /cms

define('ENV', 'Cms');
define('ENV_PATH', '/../');
define('ENV_NAMESPACE', 'Cms');

define('DS', DIRECTORY_SEPARATOR);

require_once 'raindrop/Bootstrap.php';