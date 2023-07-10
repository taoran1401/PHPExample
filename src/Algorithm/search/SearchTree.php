<?php
/**
 * 二叉排序树/二叉查找树
 */

/**
 * 结点
 *
 * Class Node
 */
class Node
{
    public $left = null;
    public $right = null;
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
}

/**
 * Class SearchTree
 */
class SearchTree
{
    /**
     * 添加
     *
     * @param Node $tree
     * @param $value
     * @return bool|void
     */
    public function add(Node $tree, $value)
    {
        if (is_null($tree)) {
            return false;
        }

        $newNode = new Node($value);
        while ($tree != null) {
            if ($newNode->data < $tree->data) {
                //插入值比根结点值小
                if ($tree->left === null) {
                    //左子树为空， 可以插入
                    $tree->left = $newNode;
                    return true;
                }
                //左子树有结点，不能直接插入，把该节点设置根结点继续判断
                $tree = $tree->left;
            } else {
                //插入值大于等于根结点值
                if ($tree->right === null) {
                    //右子树为空， 可以插入
                    $tree->right = $newNode;
                    return true;
                }
                //右子树有结点，不能直接插入，把该节点设置根结点继续判断
                $tree = $tree->right;
            }
        }
        return true;
    }

    /**
     * 删除
     *
     * 1. 当删除的结点没有子结点时，只需要将父结点中指向删除结点的指针设为null
     * 2. 当删除的结点只有一个结点时，只需要更新父结点中指向删除结点的指针指向要删除结点的子节点
     * 3. 当删除的结点有两个节点时：需要找到这个结点的右子树中最小结点，把它替换到要删除的结点上，然后再删除这个最小结点
     *  3.1: 为什么是右子树的最小结点，因为右子树的最小结点满足左子树上所有结点值均小于它，而右子树上所有结点值均大于它； 符合二叉排序树的性质
     *  3.2: 反之，找右子树的最大结点
     *
     *
     * @param Node $tree
     * @param $value
     * @param null $flag    标记是进入左子树还是右子树
     * @return bool
     */
    public function delete(Node &$tree, $value, $flag = null)
    {
        if (is_null($tree)) {
            return false;
        }
        if ($value > $tree->data) {
            //进入右子树查找
            $this->delete($tree->right, $value, 'right');
        } else if ($value < $tree->data) {
            //进入左子树查找
            $this->delete($tree->left, $value, 'left');
        } else {
            //找到并删除
            if ($tree->left === null) {
                //左子树为空时，只需要重新接它的右子树
                $tree = $tree->right;
            } else if ($tree->right === null) {
                //右子树为空时，只需要重新接它的左子树
                $tree = $tree->left;
            } else {
                //左右子树不为空，找到右子树的最左结点(即右子树的最小结点)
                if ($flag == 'left') {
                    //找到左子树的最右结点(即左子树的最大结点)
                    $delNode = $tree->right;
                    while (!is_null($delNode->right)) {
                        $delNode = $delNode->right;
                    }
                    //删除已经替换的结点
                    $tree->right = null;
                } else if ($flag == 'right') {
                    //找到右子树的最左结点(即右子树的最小结点)
                    $delNode = $tree->left;
                    while (!is_null($delNode->left)) {
                        $delNode = $delNode->left;
                    }
                    $tree->data = $delNode->data;
                    //删除已经替换的结点
                    $tree->left = null;
                } else {
                    return false;
                }
            }
        }
        return true;
    }
}

//test
$tree = New Node(62);

$sn = New SearchTree();
$sn->add($tree,58);
$sn->add($tree, 88);
$sn->add($tree, 47);
$sn->add($tree, 73);
$sn->add($tree, 99);
$sn->add($tree, 35);
$sn->add($tree, 51);
$sn->add($tree, 93);
$sn->add($tree, 37);

//print_r($tree);    //打印对象查看结构是否正确
/*
Node Object
(
    [left] => Node Object
        (
            [left] => Node Object
                (
                    [left] => Node Object
                        (
                            [left] =>
                            [right] => Node Object
                                (
                                    [left] =>
                                    [right] =>
                                    [data] => 37
                                )

                            [data] => 35
                        )

                    [right] => Node Object
                        (
                            [left] =>
                            [right] =>
                            [data] => 51
                        )

                    [data] => 47
                )

            [right] =>
            [data] => 58
        )

    [right] => Node Object
        (
            [left] => Node Object
                (
                    [left] =>
                    [right] =>
                    [data] => 73
                )

            [right] => Node Object
                (
                    [left] => Node Object
                        (
                            [left] =>
                            [right] =>
                            [data] => 93
                        )

                    [right] =>
                    [data] => 99
                )

            [data] => 88
        )

    [data] => 62
)
 */

//删除元素
//$sn->delete($tree, 47);
$sn->delete($tree, 88);

//再次打印结果,查看结构
print_r($tree);

/*
Node Object
(
    [left] => Node Object
        (
            [left] => Node Object
                (
                    [left] => Node Object
                        (
                            [left] =>
                            [right] => Node Object
                                (
                                    [left] =>
                                    [right] =>
                                    [data] => 37
                                )

                            [data] => 35
                        )

                    [right] => Node Object
                        (
                            [left] =>
                            [right] =>
                            [data] => 51
                        )

                    [data] => 47
                )

            [right] =>
            [data] => 58
        )

    [right] => Node Object
        (
            [left] =>
            [right] => Node Object
                (
                    [left] => Node Object
                        (
                            [left] =>
                            [right] =>
                            [data] => 93
                        )

                    [right] =>
                    [data] => 99
                )

            [data] => 73
        )

    [data] => 62
)
*/
