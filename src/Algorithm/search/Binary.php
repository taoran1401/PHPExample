<?php
/**
 * 折半查找/二分查找
 */
function binary(array $data, int $low, int $high, int $key)
{
    if ($low >  $high) {
        return -1;
    }
    //中间值索引
    $mid = intval(($low + $high) / 2);
    if ($key < $data[$mid]) {
        //大于查找值
        return binary($data, $low, $mid - 1, $key);
    } else if ($key > $data[$mid]) {
        //小于查找值
        return binary($data, $mid + 1, $high, $key);
    } else {
        //找到查找值
        return $mid;
    }
}

//test

//二分查找要求线性表必须采用顺序存储结构
//$data = [50, 10, 90, 30, 70, 40, 80, 60, 20]; //错误结构
$data = [10, 20, 30, 40, 50, 60, 70, 80, 90];
var_dump(binary($data, 0, count($data), 70));

