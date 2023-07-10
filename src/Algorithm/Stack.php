<?php

/**
 * 栈(数组方式)
 *
 * Class Stack
 */
class Stack
{
    /** @var int 容量 */
    private $cap;

    /** @var array 栈 */
    private $stack;

    /** @var 最新元素索引 */
    private $top = -1;

    /**
     * 初始化
     *
     * Stack constructor.
     */
    public function __construct(int $cap)
    {
        $this->cap = $cap;
        $this->stack = [];
    }

    /**
     * 入栈
     */
    public function push($item)
    {
        if ($this->top >= $this->cap) {
            throw new \Exception("stack is full.");
        }
        $this->top++;
        $this->stack[$this->top] = $item;
        return true;
    }

    /**
     * 出栈
     */
    public function pop()
    {
        if ($this->top < 0) {
            throw new \Exception("stack is empty.");
        }
        $item = $this->stack[$this->top];
        unset($this->stack[$this->top]);
        $this->top--;
        return $item;
    }

    /**
     * 获取
     */
    public function getAllByStr()
    {
        if ($this->top < 0) {
            throw new \Exception("stack is empty.");
        }
        $str = '';
        for ($i = 0; $i < $this->cap; $i++) {
            $str .= $this->stack[$i] . PHP_EOL;
        }
        return $str;
    }
}


//test
try {
    $stack = new Stack(5);
    $stack->push('A');
    $stack->push('B');
    $stack->push('C');
    $stack->push('D');
    $stack->push('E');
    //$stack->push('F');  //超出容量

    var_dump($stack->getAllByStr());

    $stack->pop();
    $stack->pop();
    $stack->pop();
    $stack->pop();
//    $stack->pop();

    var_dump($stack->getAllByStr());
} catch (\Exception $e) {
    echo "code：" . $e->getCode() . PHP_EOL;
    echo "msg: " .  $e->getMessage() . PHP_EOL;
    echo "line: " . $e->getLine() . PHP_EOL;
    echo "trace: " . $e->getTraceAsString() . PHP_EOL;
}


