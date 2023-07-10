<?php

/**
 * 冒泡排序
 *
 * @param array $data
 * @return array
 */
function bubbling(array &$data)
{
    $n = count($data);
    //进行n-1轮迭代
    for ($i = $n - 1; $i > 0; $i--) {
        //标记在一轮中有没有进行过交换
        $flag = false;
        for ($j = 0; $j < $i; $j++) {
            //比较前后元素的大小，如果前面元素小于后面元素那么交换两个的值
            if ($data[$j] > $data[$j+1]) {
                $tmp = $data[$j];
                $data[$j] = $data[$j+1];
                $data[$j+1] = $tmp;
                //这一轮中发生过交换，标记记为true
                $flag = true;
            }
        }
        //如果这一轮中没有进行过交换，说明已经没有需要排序的项
        if (!$flag) {
            return true;
        }
    }
}

$data = [5, 9, 1, 6, 8, 14, 6, 49, 25, 4, 6, 3];
//$data = [2, 1, 3, 4, 5, 6, 7];
bubbling($data);
print_r($data);