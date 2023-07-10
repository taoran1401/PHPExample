<?php

$startMemory = memory_get_usage();

function readCsv()
{
    $file = fopen('./demo.csv', 'r');
    while (feof($file) === false) {
        yield fgetcsv($file);
    }
    fclose($file);
}
foreach (readCsv() as $key => $value) {
    var_dump($value);
}
$endMemory = memory_get_usage();
$useMemory = round(($endMemory - $startMemory) / 1024 / 1024, 3) . 'M' . PHP_EOL;
var_dump($useMemory);


