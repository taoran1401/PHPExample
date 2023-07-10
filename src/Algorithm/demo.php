<?php
/**
 * 单个循环情况
 *
 * @param $n
 */
function demoOne($n)
{
    for ($i = 0; $i < $n; $i++) {   //循环次数为n
        echo "output..." . PHP_EOL; //循环体时间复杂度为O(1)
    }
}
//时间复杂度计算: O(n * 1), 即O(n)

/**
 * 多重循环体情况
 *
 * @param $n
 */
function demoTwo($n)
{
    for ($i = 0; $i < $n; $i++) {       //循环次数为n
        for ($j = 0; $j < $n; $j++) {   //循环次数为n
            echo "output..." . PHP_EOL; //循环体次数为O(1)
        }
    }
}
//时间复杂度计算: O(n * n * 1), 即O(n^2)

/**
 * 多个事件复杂度情况
 *
 * @param $n
 */
function demoThree($n)
{
    //该部分时间复杂度为O(n^2)
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n; $j++) {
            echo "output..." . PHP_EOL;
        }
    }

    //该部分时间复杂度为O(n)
    for ($j = 0; $j < $n; $j++) {   //循环次数为n
        echo "output..." . PHP_EOL; //循环体次数为O(1)
    }
}
//时间复杂度计算: max(O(n^2), O(n)), 即O(n^2)