<?php
/**
 * 快速排序
 *
 * @param array $data
 */
function quick(array $data)
{
    $n = count($data);
    if ($n <= 1) {
        return $data;
    }

    //计算中间索引
    $midIndex = floor($n / 2);
    //中间值
    $mid = $data[$midIndex];
    $left = [];
    $right = [];
    for ($i = 0; $i < $n; $i++) {
        //跳过中间索引
        if ($midIndex == $i) {
            continue;
        }

        //小于等于中间值的放到左侧
        if ($data[$i] <= $mid) {
            $left[] = $data[$i];
        }

        //大于中间值的放到右侧
        if ($data[$i] > $mid) {
            $right[] = $data[$i];
        }
    }
    //递归
    return array_merge(quick($left), [$mid], quick($right));
}

$data = [5, 9, 1, 6, 8, 14, 6, 49, 25, 4, 6, 3];
var_dump(quick($data));