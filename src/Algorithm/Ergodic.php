<?php

class Node
{
    public $data;

    public $childLeft;

    public $childRight;

    public function __construct($data)
    {
        $this->data = $data;
        $this->childLeft = null;
        $this->childRight = null;
    }
}

class Ergodic
{
    /**
     * 前序遍历：先访问根结点，然后前序遍历左子树，再前序遍历右子树
     */
    public function preOrder($tree)
    {
        if ($tree instanceof Node) {
            //先访问根结点
            echo $tree->data . ' ';
            //前序遍历左子树
            $this->preOrder($tree->childLeft);
            //前序遍历右子树
            $this->preOrder($tree->childRight);
        }
    }

    /**
     * 中序遍历：先中序遍历根结点的左子树，然后是访问根结点，最后中序遍历右子树
     */
    public function midOrder($tree)
    {
        if ($tree instanceof Node) {
            //先中序遍历根结点的左子树
            $this->midOrder($tree->childLeft);
            //访问根结点
            echo $tree->data . " ";
            //中序遍历右子树
            $this->midOrder($tree->childRight);
        }
    }

    /**
     * 后序遍历：从左到右先叶子后结点的方式遍历访问左右子树，最后访问根结点
     */
    public function endOrder($tree)
    {
        if ($tree instanceof Node) {
            //后序遍历左子树
            $this->endOrder($tree->childLeft);
            //后序遍历右子树
            $this->endOrder($tree->childRight);
            //最后访问根结点
            echo $tree->data . " ";
        }
    }

    /**
     * 层序遍历：从树的第一层，也就是根结点开始访问，从上而下逐层遍历，在同一层中，按从左到有的顺序对结点逐个访问
     */
    public function levelOrder($tree)
    {
        $queue = [];
        //向队列尾部添加元素
        array_push($queue, $tree);
        while (!empty($queue)) {
            //从队列头部取出元素
            $node = array_shift($queue);
            echo $node->data . " ";
            if ($node->childLeft instanceof Node) {
                array_push($queue, $node->childLeft);
            }

            if ($node->childRight instanceof Node) {
                array_push($queue, $node->childRight);
            }
        }
    }
}

//创建二叉树
$a = new Node("A");
$b = new Node("B");
$c = new Node("C");
$d = new Node("D");
$e = new Node("E");
$f = new Node("F");

$a->childLeft = $b;
$a->childRight = $c;
$b->childLeft = $d;
$b->childRight = $e;
$c->childLeft = $f;

$ergodic = new Ergodic();
$ergodic->preOrder($a); //结果：A B D E C F
echo PHP_EOL;
$ergodic->midOrder($a); //结果：D B E A F C
echo PHP_EOL;
$ergodic->endOrder($a); //结果：D E B F C A
echo PHP_EOL;
$ergodic->levelOrder($a); //结果：A B C D E F
echo PHP_EOL;

/*
    wz: qg, jz
    gq bz: ry(buff: 2, zb: 2); zh(xie: 1); jz(xie: 1); xiaz1(xie: 1); xiaz2(xie: 1); lvr(xie: 1)
 */