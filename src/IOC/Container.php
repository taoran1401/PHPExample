<?php

namespace Taoran\PhpExample\Ioc;

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    /**
     * 解析器
     * @var
     */
    private $resolverDispatcher;

    private $resolvedEntries = [];

    public function __construct()
    {
        //获取解析程序
        $this->resolverDispatcher = new ResolverDispatcher($this);
        //注册容器
        $this->resolvedEntries = [
            self::class => $this,
            ContainerInterface::class => $this,
        ];
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     * 根据容器的标识符查找条目并返回。
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get(string $id)
    {
        //获取条目，如果已经解析则返回它
    }

    public function has(string $id): bool
    {
        // TODO: Implement has() method.
    }


    public function make()
    {

    }

    /**
     * 标识绑定条目
     */
    public function set()
    {

    }
}

