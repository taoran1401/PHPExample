<?php

ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');
ini_set('memory_limit', '1G');

error_reporting(E_ALL);

! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 2));
! defined('SWOOLE_HOOK_FLAGS') && define('SWOOLE_HOOK_FLAGS', SWOOLE_HOOK_ALL);

require BASE_PATH . '/vendor/autoload.php';
$container = new \Taoran\PhpExample\Ioc\Container();
if (!($container instanceof Psr\Container\ContainerInterface)) {
    throw new RuntimeException('The dependency injection container is invalid.');
}

var_dump($container);exit;