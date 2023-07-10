<?php


namespace Taoran\PhpExample\Ioc;

use Psr\Container\ContainerInterface;

/**
 * 解析
 *
 * Class ResolverDispatcher
 * @package Taoran\PhpExample\Ioc
 */
class ResolverDispatcher
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * 解析
     */
    public function resolve()
    {

    }

    /**
     * 检查是否可以解析
     */
    public function isResolvable()
    {

    }
}