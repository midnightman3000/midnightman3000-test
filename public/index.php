<?php

require_once __DIR__.'/../vendor/autoload.php';

use Alex\Core;
use Alex\Helper\CoreHelper;

define('SYSTEM_PATH', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('CONFIG_FILE', SYSTEM_PATH . 'system' . DIRECTORY_SEPARATOR . 'config.yml');

define('PUBLIC_KEY', CoreHelper::getKeyDirectory() . CoreHelper::PUBLIC_KEY);
define('PRIVATE_KEY', CoreHelper::getKeyDirectory() . CoreHelper::PRIVATE_KEY);

$app = new Silex\Application();

Core::init($app);

$app->mount('/index', new Alex\Controller\IndexController());

$app->mount('/user', new Alex\Controller\UserController());
$app->mount('/router', new Alex\Controller\ProxyController());

$app['debug'] = true;

$app->run();