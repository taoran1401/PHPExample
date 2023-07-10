<?php

/**
 * 斐波那契查找
 */
function fibonacciSearch(array $data, $key)
{
    $n = count($data);
    //定义最低下标记录首位
    $low = 0;
    //定义最高下标记录末位
    $high = $n - 1;

    $k = 0;
    //计算n位于斐波那契数列的位置
    while ($n > fibonacci($k) - 1) {
        $k++;
    }

    //将不满的数值的补全
    for ($j = $n; $j < fibonacci($k) - 1; $j++) {
        $data[$j] = $data[$n - 1];
    }

    //查找
    while ($low <= $high) {
        //echo "---" . PHP_EOL;
        //计算当前分隔的下标
        $mid = $low + fibonacci($k - 1) - 1;
        //echo '$k = ' . $k . PHP_EOL;
        if ($key < $data[$mid]) {
            //echo "$key < $data[$mid]" . PHP_EOL;
            $high = $mid - 1;
            $k = $k - 1;
            //echo '$high 和 $k 和 $mid' . " $high, $k, $mid" . PHP_EOL;
        } else if ($key > $data[$mid]) {
            //echo "$key > $data[$mid]" . PHP_EOL;
            $low = $mid + 1;
            $k = $k - 2;
            //echo '$high 和 $k 和 $mid' . " $high, $k, $mid" . PHP_EOL;
        } else {
            if ($mid <= $n) {
                //找到元素位置
                return $mid;
            } else {
                //说明是补全的数值，补全的数值和n相同，那么直接返回n
                return $n;
            }
        }
    }
}

/**
 * 构建斐波那契数列
 */
function fibonacci($i)
{
    if ($i < 2) {
        $value = $i == 0 ? 0 : 1;
    } else {
        $value = fibonacci($i - 1) + fibonacci($i - 2);
    }
    return $value;
}


//test
$data = [0, 1, 16, 24, 35, 47, 59, 62, 73, 88, 99];
var_dump(fibonacciSearch($data, 73));