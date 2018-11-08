<?php
/**
 * 二维数组按照键值降序排序
 * @param array $arr   待排序数组
 * @param string $key  键值
 * @return mixed
 */
function sortByKeyDesc($arr, $key) {

    array_multisort(array_column($arr, $key), SORT_DESC, $arr);
    return $arr;

}

/**
 * 二维数组按照键值升序排序
 * @param array $arr   待排序数组
 * @param string $key  键值
 * @return mixed
 */
function sortByKeyAsc($arr, $key) {

    array_multisort(array_column($arr, $key), SORT_ASC, $arr);
    return $arr;

}

$arr = [
    ['name' => 'itbsl', 'priority' => 23],
    ['name' => 'jack', 'priority' => 3],
    ['name' => 'rose', 'priority' => 12],
    ['name' => 'pick', 'priority' => 45],
    ['name' => 'binbin', 'priority' => 68],
    ['name' => 'didi', 'priority' => 56789],
    ['name' => 'mobike', 'priority' => 0],
];

$result = sortByKeyDesc($arr, 'priority');
?>