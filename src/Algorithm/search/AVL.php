<?php
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);

class AvlNode
{
    public $data;
    public $left;
    public $right;
    public $height = 1;

    /**
     * 初始化结点
     *
     * AvlNode constructor.
     * @param $data
     */
    public function __construct($data, $height = 1)
    {
        $this->data = $data;
        $this->height = $height;
    }
}

class AvlTree
{
    public $root;

    /**
     * 添加结点
     *
     * @param $data
     * @return bool
     * @throws Exception
     */
    public function add($data)
    {
        $this->root = $this->_addHandle($this->root, $data);
        return true;
    }

    /**
     * 添加结点 - 具体操作
     *
     * @param $node
     * @param $data
     * @return mixed|null
     * @throws Exception
     */
    private function _addHandle(&$node, $data)
    {
        if (!($node instanceof AvlNode)) {
            $node = new AvlNode($data, 1);
        }
        $newNode = null;
        if ($data == $node->data) {
            return $node;
        }

        if ($data > $node->data) {
            //右子树插入
            $node->right = $this->_addHandle($node->right, $data);
            //计算平衡因子: 插入右子树后，要确保左子树高度不能比右子树低一层
            $bf = $this->balanceFactor($node);
            if ($bf == -2) {
                //失衡
                if ($data > $node->right->data) {
                    //右右情况，表示在右子树上插入右儿子导致失衡，使用左旋
                    $newNode = $this->leftRotation($node);
                } else {
                    //右左情况，表示右子树上插入左儿子导致失衡，使用先右后左旋
                    $newNode = $this->rightLeftRotation($node);
                }
            }
        } else {
            //左子树插入
            $node->left = $this->_addHandle($node->left, $data);
            //平衡因子
            $bf = $this->balanceFactor($node);
            if ($bf == 2) {
                //失衡
                if ($data < $node->left->data) {
                    //左左情况，表示在左子树上插入左儿子导致失衡，使用右旋
                    $newNode = $this->rightRotation($node);
                } else {
                    //左右情况，表示左子树上插入右儿子导致失衡，使用先左后右旋
                    $newNode = $this->leftRightRotation($node);
                }
            }
        }

        if (!($newNode instanceof AvlNode)) {
            //表示无旋转，根结点没变，直接刷新树高度
            $this->updateHeight($node);
            return $node;
        } else {
            //旋转了，根结点改变，需要刷新树根结点高度
            $this->updateHeight($newNode);
            return $newNode;
        }
    }

    /**
     * 右右情况：在右子树上插上右儿子导致失衡，左旋，转一次
     */
    public function leftRotation(&$root)
    {
        //root：是失去平衡的树的根结点
        //pivot: 是旋转后重新平衡的树的根结点，方便下面称呼这里可以称为支点
        //b: 是支点左子树结点，旋转后将转移到root的右侧
        //结合wiki图示，此时pivot、B、root发生了变化
        $pivot = $root->right;
        $b = $pivot->left;
        $pivot->left = $root;
        $root->right = $b;

        //node和pivot发生了高度变化
        $this->updateHeight($root);
        $this->updateHeight($pivot);
        return $pivot;
    }

    /**
     * 左左情况：在左子树上插上左儿子导致失衡，右旋，转一次
     */
    public function rightRotation(&$root)
    {
        //root：是失去平衡的树的根结点
        //pivot: 是旋转后重新平衡的树的根结点，方便下面称呼这里可以称为支点
        //b: 是支点右子树结点，旋转后将转移到root的左侧
        //结合wiki图示，此时pivot、B、root发生了变化
        $pivot = $root->left;
        $b = $pivot->right;
        $pivot->right = $root;
        $root->left = $b;

        //node和pivot发生了高度变化
        $this->updateHeight($root);
        $this->updateHeight($pivot);
        return $pivot;
    }

    /**
     * 左右情况：在左子树上插上右儿子导致失衡，先左后右旋，转两次。
     */
    public function leftRightRotation(&$node)
    {
        $node->left = $this->leftRotation($node->left);
        return $this->rightRotation($node);
    }

    /**
     * 右左情况：在右子树上插上左儿子导致失衡，先右后左旋，转两次
     */
    public function rightLeftRotation(&$node)
    {
        $node->right = $this->rightRotation($node->right);
        return $this->leftRotation($node);
    }

    /**
     * 更新结点高度
     */
    public function updateHeight(&$node)
    {
        if (!($node instanceof AvlNode)) {
            return;
        }

        $leftHeight = 0;
        $rightHeight = 0;

        //左子树高度
        if ($node->left instanceof AvlNode) {
            $leftHeight = $node->left->height;
        }

        //右子树高度
        if ($node->right instanceof AvlNode) {
            $rightHeight = $node->right->height;
        }

        //高度最高的子树+1就是当前结点的高度
        $maxHeight = max($leftHeight, $rightHeight);
        $node->height = $maxHeight + 1;
    }

    /**
     * 计算平衡因子: 左子树高度 - 有子树高度
     *
     */
    public function balanceFactor($node)
    {
        if (!($node instanceof AvlNode)) {
            throw new \Exception("计算平衡因子err: 非结点");
        }

        $leftHeight = 0;
        $rightHeight = 0;
        if ($node->left instanceof AvlNode) {
            $leftHeight = $node->left->height;
        }

        if ($node->right instanceof AvlNode) {
            $rightHeight = $node->right->height;
        }

        return $leftHeight - $rightHeight;
    }


    /**
     * 查找结点
     *
     * @param $data
     * @return mixed|null
     * @throws Exception
     */
    public function find($data)
    {
        return $this->_findHandle($this->root, $data);
    }

    /**
     * 查找结点 - 具体操作
     */
    private function _findHandle($node, $data)
    {
        if (!($node instanceof AvlNode)) {
            throw new \Exception("参数错误：不是结点");
        }

        if ($data == $node->data) {
            return $node;
        } else if ($data > $node->data) {
            if (!($node->right instanceof AvlNode)) {
                //右子树为空，表示找不到该值了，返回null
                return null;
            }
            return $this->_findHandle($node->right, $data);
        } else {
            if (!($node->left instanceof AvlNode)) {
                //左子树为空，表示找不到该值了，返回null
                return null;
            }
            return $this->_findHandle($node->left, $data);
        }
    }

    /**
     * 删除结点
     */
    public function del($data)
    {
        //空树，直接返回
        if (!($this->root instanceof AvlNode)) {
            return true;
        }
        $this->root = $this->_delHandle($this->root, $data);
        return true;
    }

    /**
     * 删除结点 - 具体操作
     *
     * @param $node
     * @param $data
     * @return bool|mixed|null
     * @throws Exception
     */
    private function _delHandle(&$node, $data)
    {
        if (!($node instanceof AvlNode)) {
            return true;
        }

        if ($data < $node->data) {
            //从左子树开始删除
            $node->left = $this->_delHandle($node->left, $data);
            //更新高度
            $this->updateHeight($node->left);
        } else if ($data > $node->data) {
            //从右子树开始删除
            $node->right = $this->_delHandle($node->right, $data);
            //更新高度
            $this->updateHeight($node->right);
        } else {
            //找到对应结点，开始删除

            //第一种情况： 该结点没有左右子树，直接删除即可
            if (!($node->left instanceof AvlNode) && !($node->right instanceof AvlNode)) {
                return null;
            }

            if (($node->left instanceof AvlNode) && ($node->right instanceof AvlNode)) {
                //第二种情况：该结点有两棵子树，选择高度更高的子树下的结点来替换被删除的结点
                if ($node->left->height > $node->right->height) {
                    //左子树高，选择左子树中最大的结点来替换

                    //最大结点
                    $maxNode = ($node->left->right instanceof AvlNode) ? $node->left->right : $node->left;
                    //最大值的结点替换被删结点
                    $node->data = $maxNode->data;
                    //删除最大结点
                    $this->_delHandle($node->left, $maxNode->data);
                    //更新该结点高度
                    $this->updateHeight($node->left);
                } else {
                    //右子树更高：选择右子树中最小的结点来替换

                    //最小结点
                    $minNode =  ($node->right->left instanceof AvlNode) ? $node->right->left : $node->right;
                    //最小值的结点替换被删结点
                    $node->data = $minNode->data;
                    //删除最小结点
                    $this->_delHandle($node->right, $minNode->data);
                    //更新该结点高度
                    $this->updateHeight($node->right);
                }

            } else {
                //只有左子树或者右子树； 只有一个子树，该子树也只是一个结点，将该结点替换被删除的结点，然后置子树为空
                if ($node->left instanceof AvlNode) {
                    //第三种情况：删除的结点只有左子树，可以知道左子树其实就只有一个结点，被删除结点本身（假设左子树多于2个结点，那么高度差就等于2了，不符合AVL树定义），将左结点替换被删除的结点，最后删除这个左结点，变成情况1。
                    $node->data = $node->left->data;
                    $node->left = null;
                } else {
                    //第四种情况：删除的结点只有右子树，可以知道右子树其实就只有一个结点，被删除结点本身（假设右子树多于2个结点，那么高度差就等于2了，不符合AVL树定义），将右结点替换被删除的结点，最后删除这个右结点，变成情况1。
                    $node->data = $node->right->data;
                    $node->right = null;
                }
            }

            //找到值，进行替换删除后返回该结点
            return $node;
        }

        //删除后平衡控制
        $newNode = null;
        $bf = $this->balanceFactor($node);
        if ($bf == -2) {
            //失衡: 删除左子树结点导致右边比左边高了
            if ($this->balanceFactor($node->right) <= 0) {
                $newNode = $this->leftRotation($node);
            } else {
                $newNode = $this->rightLeftRotation($node);
            }
        } else if ($bf == 2) {
            //失衡：删除右子树结点导致左边比右边高了
            if ($this->balanceFactor($node->left) >= 0) {
                $newNode = $this->rightRotation($node);
            } else {
                $newNode = $this->leftRightRotation($node);
            }
        }

        if (!($newNode instanceof AvlNode)) {
            //表示无旋转，根结点没变，直接刷新树高度
            $this->updateHeight($node);
            return $node;
        } else {
            //旋转了，根结点改变，需要刷新树根结点高度
            $this->updateHeight($newNode);
            return $newNode;
        }
    }
}

//test
try {
    $AvlTree = new AvlTree();
//    $data = [3,4,5];
//    $data = [3,5,6];
    //$data = [3,2,1,4,5,6,7,10,9,8];
    $data = [22,8,26,4,18,24,28,2,6,14,20,30,1,3,5,7,12,16];
//    $data = [22,8,26,4,18,24,28,30];
    foreach ($data as $v) {
        $AvlTree->add($v);
    }
    echo "结果：" . PHP_EOL;
    //打印完整二叉平衡树
    //print_r($AvlTree->root);

    //查找指定结点
    //print_r($AvlTree->find(7));

    //删除
    $AvlTree->del(24);

    //再次查看
    print_r($AvlTree->root);
    exit;
}catch (\Exception $e) {
    var_dump("line: " . $e->getLine());
    var_dump("message: " . $e->getMessage());
    var_dump("trace: " . $e->getTraceAsString());
}
