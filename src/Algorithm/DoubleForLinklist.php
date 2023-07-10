<?php

/**
 * 节点类
 *
 * Class Node
 */
class Node
{
    /** @var 数据 */
    public $data;

    /** @var 前驱 */
    public $prev;

    /** @var 后继 */
    public $next;

    public function __construct($data)
    {
        $this->data = $data;
    }
}

/**
 * 双向链表类
 *
 * Class DoubleForLinklist
 */
class DoubleForLinklist
{
    /** @var 首节点 */
    private $head;

    /** @var 尾节点 */
    private $tail;

    /** @var 链表长度 */
    private $len;

    /**
     * 初始化链表
     *
     * DoubleForLinklist constructor.
     */
    public function __construct()
    {
    }

    /**
     * 获取单链表长度
     */
    public function getLen(): int
    {
        return $this->len;
    }

    /**
     * 获取全部节点
     *
     * @return string
     */
    public function getAll(): string
    {
        $str = "";
        //获取首节点
        $node = $this->head;

        //计数索引
        $countIndex = 0;
        //从首节点遍历所有节点
        while ($node instanceof Node) {
//            var_dump($node);
//            echo "---" . PHP_EOL;
            $str .= "{$countIndex}: {$node->data}" . PHP_EOL;
            $node = $node->next;
            $countIndex++;
        }
        return $str;
    }

    /**
     * 查找节点（这里根据索引获取，也可以用值获取）
     *
     * @param int $index    索引
     * @return 后继|首节点|null
     */
    public function get(int $index)
    {
        //计数
        $countIndex = 0;
        //头节点
        $node = $this->head;
        //从头节点循环获取指定索引对应的结点
        while ($node instanceof Node) {
            if ($countIndex == $index) {
                return $node;
            }
            $node = $node->next;
            $countIndex++;
        }
        return null;
    }

    /**
     * 添加节点
     *
     * @param $item 元素
     * @param null $index 索引
     * @return bool
     * @throws Exception
     */
    public function add($item, $index = null)
    {
        //检查边界
        $this->_checkIndex($index);
        //创建节点
        $node = new Node($item);
        if ($index === null) {
            //索引为null，表示从尾部添加
            if ($this->tail instanceof Node) {
                //链表尾节点是一个节点，说明链表中已经存在节点
                $node->prev = $this->tail;  //节点前驱 == 链表当前尾节点
                $this->tail->next = $node;  //尾节点的后继指针 == 当前节点
                $this->tail = $node;        //此时链表尾节点 == 当前节点
            } else {
                //链表尾节点不是一个节点，说明链表中没有元素，这时首节点和尾节点相同
                $this->head = $node;
                $this->tail = $node;
            }
        } else {
            //从指定索引添加
            //获取旧的节点
            $oldNode = $this->get($index);
            //当旧节点是Node的实例时替换旧节点
            if ($oldNode instanceof Node) {
                if ($oldNode->prev instanceof Node) {
                    //当旧节点的前驱是一个节点时，旧节点的前驱的后继应该更换为当前节点
                    $oldNode->prev->next = $node;
                }
                $node->next = $oldNode; //当前节点的后继指针 为 旧节点
                $node->prev = $oldNode->prev;   //当前节点的前驱 为 旧节点的前驱
                $oldNode->prev = $node; //旧节点的前驱 为 当前节点
            }

            //判断是否头节点
            if ($node->prev === null) {
                $this->head = $node;
            }

            //判断是否尾节点
            if ($node->next === null) {
                $this->tail = $node;
            }
        }
        $this->len++;
        return true;
    }

    /**
     * 修改节点
     *
     * @param $index
     * @param $item
     * @return bool
     * @throws Exception
     */
    public function update($index, $item)
    {
        $node = $this->get($index);
        if (!($node instanceof Node)) {
            throw new \Exception("节点不存在");
        }
        $node->data = $item;
        return true;
    }

    /**
     * 删除节点
     *
     * @param $index
     * @return bool
     * @throws Exception
     */
    public function delete($index)
    {
        $this->_checkIndex($index);
        $node = $this->get($index);
        //存在前驱
        if ($node->prev instanceof Node) {
            if ($node->next instanceof Node) {
                //当该节点的后继还是节点的情况，该节点的前驱节点的后继变为该节点的后继
                $node->prev->next = $node->next;
            } else {
                //当该节点的后继不是是节点的情况说明当前是尾节点，值为null
                $node->prev->next = null;
            }
        }

        //存在后继
        if ($node->next instanceof Node) {
            if ($node->prev instanceof null) {
                //当该节的前驱还是节点的情况, 该节点的后继节点的前驱变为该节点的前驱
                $node->next->prev = $node->prev;
            } else {
                //当该节的前驱不是节点的情况说明当前是首节点，值为null
                $node->next->prev = null;
            }

        }
        unset($node);
        $this->len--;
        return true;
    }

    /**
     * 获取节点索引值
     */
    public function getIndex($item)
    {
        $node = $this->head;
        $countIndex = 0;
        while ($node instanceof Node) {
            if ($node->data == $item) {
                return $countIndex;
            }
            $node = $node->next;
            $countIndex++;
        }
        //未找到
        return -1;
    }

    /**
     * 检查索引是否越界
     *
     * @param int $index
     * @throws Exception
     */
    private function _checkIndex($index)
    {
        if ($index && $index >= $this->len) {
            throw new \Exception("index越界");
        }
    }
}

//tests
try{
    $linklist = new DoubleForLinklist();
    $linklist->add('A');                    //末尾插入元素
    $linklist->add('B');                    //末尾插入元素
    $linklist->add('C');                    //末尾插入元素
    $linklist->add('D', 0);          //更换首节点
    $linklist->add('E', 2);          //中间插入节点
    var_dump($linklist->get(2));                 //查看指定索引节点

    var_dump($linklist->getAll());               //查看全部节点
    $linklist->delete(1);                  //删除接节点
    var_dump($linklist->getAll());

    $linklist->update(1, "EE");      //更改指定索引位置的内容
    var_dump($linklist->getAll());

    echo "链表长度:" . $linklist->getLen() . PHP_EOL;                         //获取链表长度

    echo "获取指定内容索引：" . $linklist->getIndex("EE") . PHP_EOL;

} catch (\Exception $e) {
    echo "code：" . $e->getCode() . PHP_EOL;
    echo "msg: " .  $e->getMessage() . PHP_EOL;
    echo "line: " . $e->getLine() . PHP_EOL;
    echo "trace: " . $e->getTraceAsString() . PHP_EOL;
}
