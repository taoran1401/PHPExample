<?php
/**
 * 插值查找
 */
function interpolation(array $data, int $low, int $high, int $key)
{
    if ($low >  $high) {
        return -1;
    }
    //中间值索引
    $mid = intval($low + ($key - $data[$low]) / ($data[$high] - $data[$low]) * ($high - $low));
    if ($key < $data[$mid]) {
        //大于查找值
        return interpolation($data, $low, $mid - 1, $key);
    } else if ($key > $data[$mid]) {
        //小于查找值
        return interpolation($data, $mid + 1, $high, $key);
    } else {
        //找到查找值
        return $mid;
    }
}

//test
$data = [10, 20, 30, 40, 50, 60, 70, 80, 90, 91, 101, 110, 129];
var_dump(interpolation($data, 0, count($data) - 1, 11));
