<?php

ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');
ini_set('memory_limit', '1G');

error_reporting(E_ALL);

! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 3));
! defined('SWOOLE_HOOK_FLAGS') && define('SWOOLE_HOOK_FLAGS', SWOOLE_HOOK_ALL);


require BASE_PATH . '/vendor/autoload.php';

var_dump((new \Hyperf\Di\Definition\DefinitionSourceFactory(true))());
exit;
//获取容器类(Container)
$container = new \Hyperf\Di\Container((new \Hyperf\Di\Definition\DefinitionSource(true)));

//获取应用类(App)

var_dump(123);exit;