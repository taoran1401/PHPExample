<?php

/**
 * 队列(数组方式)
 *
 * Class Queue
 */
class Queue
{
    /** @var array 队列 */
    private $queue;

    /**
     * 初始化
     *
     * Stack constructor.
     */
    public function __construct()
    {
        $this->queue = [];
    }

    /**
     * 队列尾部添加元素
     */
    public function enqueue($item)
    {
        $this->queue[$this->getLen()] = $item;
        return true;
    }

    /**
     * 队列头部取出元素
     */
    public function dequeue()
    {
        $this->isEmpty();

        $item = $this->queue[0];
        unset($this->queue[0]);
        $this->queue = array_values($this->queue);
        return $item;
    }

    /**
     * 获取长度
     *
     * @return int
     */
    public function getLen()
    {
        return count($this->queue);
    }

    /**
     * 获取
     */
    public function getAllByStr()
    {
        $this->isEmpty();

        $str = '';
        for ($i = 0; $i < $this->getLen(); $i++) {
            $str .= $this->queue[$i] . PHP_EOL;
        }
        return $str;
    }

    /**
     * 判断是否为空
     *
     * @throws Exception
     */
    public function isEmpty()
    {
        if (empty($this->queue)) {
            throw new \Exception('queue is empty.');
        }
    }
}


//test
try {
    $queue = new Queue();
    $queue->enqueue('A');
    $queue->enqueue('B');
    $queue->enqueue('C');
    $queue->enqueue('D');
    $queue->enqueue('E');

    var_dump($queue->getAllByStr());

    $queue->dequeue();
    $queue->dequeue();
    $queue->dequeue();
    $queue->dequeue();

    var_dump($queue->getAllByStr());
} catch (\Exception $e) {
    echo "code：" . $e->getCode() . PHP_EOL;
    echo "msg: " .  $e->getMessage() . PHP_EOL;
    echo "line: " . $e->getLine() . PHP_EOL;
    echo "trace: " . $e->getTraceAsString() . PHP_EOL;
}


