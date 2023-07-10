<?php

/**
 * 顺序表 示例代码
 *
 * Class Linear
 */
class Linear {

    private $item;

    private $count;

    /**
     * 初始化
     *
     * Linear constructor.
     */
    public function __construct()
    {
        $this->item = [];
        $this->count = count($this->item);
    }

    /**
     * 输出全部元素
     *
     * @return string
     */
    public function getAll()
    {
        for ($i = 0; $i < $this->count; $i++) {
            echo $this->item[$i] . PHP_EOL;
        }
        return PHP_EOL;
    }

    /**
     * 指定位置新增元素
     *
     * @param $index
     * @param $item
     * @return bool
     */
    public function add($index, $item)
    {
        if ($index < 0 && $index > $this->count) {
            return false;
        }
        //将指定位置和后面的元素后移一位
        for ($i = $this->count; $i > $index; $i--) {
            $this->item[$i] = $this->item[$i - 1];
        }
        $this->item[$index] = $item;
        $this->count++;
        return true;
    }

    /**
     * 更新指定位置的元素
     *
     * @param $index
     * @param $item
     * @return bool
     */
    public function update($index, $item)
    {
        if ($index < 0 && $index > $this->count) {
            return false;
        }
        $this->item[$index] = $item;
        return true;
    }

    /**
     * 删除指定位置的元素
     *
     * @param $index
     * @return bool|mixed
     */
    public function delete($index)
    {
        if ($index < 0 && $index > $this->count) {
            return false;
        }
        $value = $this->item[$index];
        //将指定位置后面的元素前移一位
        for ($i = $index; $i < $this->count - 1; $i++) {
            $this->item[$i] = $this->item[$i + 1];
        }
        $this->count--;
        return $value;
    }

    /**
     * 获取长度
     *
     * @return int
     */
    public function count()
    {
        return $this->count;
    }

    /**
     * 清空顺序表
     */
    public function clear()
    {
        $this->item = [];
        $this->count = count($this->item);
    }
}

//测试
$linear = new Linear();
echo '添加：' . PHP_EOL;
$linear->add(0, 'a');
$linear->add(1, 'b');
$linear->add(1, 'c');
$linear->getAll();
echo '更新：' . PHP_EOL;
$linear->update(1, 'd');
$linear->getAll();
echo '删除' . PHP_EOL;
$linear->delete(1);
$linear->getAll();
echo '清空' . PHP_EOL;
echo $linear->count() . PHP_EOL;
$linear->clear();
echo $linear->count() . PHP_EOL;