<?php
ini_set('display_errors', 'on');

/**
 * 迭代器是一种设计模式，提供一种方法顺序访问一个聚合对象中各个元素，而又不暴露该对象的内部显示。
 *
 * Class MyIterator
 */

class MyIterator implements Iterator
{
    private $position = 0;

    private $array = array(
        "firstelement",
        "secondelement",
        "lastelement",
    );

    public function __construct() {
        $this->position = 0;
    }

    public function rewind() {
        var_dump(__METHOD__);
        $this->position = 0;
    }

    public function current() {
        var_dump(__METHOD__);
        return $this->array[$this->position];
    }

    public function key() {
        var_dump(__METHOD__);
        return $this->position;
    }

    public function next() {
        var_dump(__METHOD__);
        ++$this->position;
    }

    public function valid() {
        var_dump(__METHOD__);
        return isset($this->array[$this->position]);
    }
}

/*$myIterator = new MyIterator();
var_dump($myIterator);exit;

foreach ($myIterator as $key => $value) {
    var_dump($key, $value);
}*/


$startMemory = memory_get_usage();

$sql = 'select * from `user` limit 100000';
$pdo = new \PDO('mysql:host=127.0.0.1;dbname=user', 'root', 'root');
$pdo->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
$data = $pdo->query($sql);

$file = fopen('./demo.csv', 'w');

foreach ($data as $val) {
    fputcsv($file, [$val['id'], $val['value']]);
}
fclose($file);

$endMemory = memory_get_usage();

$useMemory = round(($endMemory - $startMemory) / 1024 / 1024, 3) . 'M' . PHP_EOL;

//10w数据处理，内存使用情况(pdo:0.065m; mysqli: 39.959m)
var_dump($useMemory);

exit;
