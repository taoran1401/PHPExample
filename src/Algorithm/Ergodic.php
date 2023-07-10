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
