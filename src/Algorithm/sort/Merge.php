<?php
/**
 * 归并排序
 *
 * @param array $data
 * @return array
 */
function mergeSort(array $data)
{
    $n = count($data);
    if ($n <= 1) {
        //已经排序完毕直接返回
        return $data;
    }
    //计算中间索引
    $midIndex = floor($n / 2);
    //分割左右数组
    $left = array_slice($data, 0, $midIndex);
    $right = array_slice($data, $midIndex, $n);
    //切分归并
    return merge(mergeSort($left), mergeSort($right));
}

function merge($left, $right)
{
    //结果存放数组
    $result = [];
    while (count($left) > 0 && count($right) > 0) {
        //比较两边第一个元素，小的放入元素放入结果数组
        if ($left[0] < $right[0]) {
            $result[] = array_shift($left);
        } else {
            $result[] =  array_shift($right);
        }
    }

    //如果左边数组还有剩余追加到结果数组
    if (count($left) > 0) {
        $result  = array_merge($result, $left);
    }

    //如果右边数组还有剩余追加到结果数组
    if (count($right) > 0) {
        $result  = array_merge($result, $right);
    }

    return $result;
}

//test
$data = [50, 10, 90, 30, 70, 40, 80, 60, 20];
var_dump(mergeSort($data));

