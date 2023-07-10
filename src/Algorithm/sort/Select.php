<?php
/**
 * 选择排序
 *
 * @param array $data
 */
function select(array &$data)
{
    $n = count($data);
    //进行n-1轮迭代
    for ($i = 0; $i <= $n - 1; $i++) {
        //记录最小数和下标
        $min = $data[$i];
        $minIndex = $i;
        for ($j = $i + 1; $j < $n; $j++) {
            //判断下一个元素是否最小数
            if ($data[$j] < $min) {
                //记录最小数和下标
                $min = $data[$j];
                $minIndex = $j;
            }
        }

        //一轮结束，判断是否有新的最小数，有则交换最小数
        if ($i != $minIndex) {
            $data[$minIndex] = $data[$i];
            $data[$i] = $min;
        }
    }
}

$data = [5, 9, 1, 6, 8, 14, 6, 49, 25, 4, 6, 3];
//$data = [2, 1, 3, 4, 5, 6, 7];
select($data);
print_r($data);