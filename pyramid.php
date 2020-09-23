<?php
$count = rand(10, 100);
$list = [];
for ($i = 0; $i < $count; ++$i) {
    $list[$i] = rand(1, 1000);
}
for ($i = $count - 1; $i > 0; --$i) {
    $j = ceil($i / 2) - 1;
    $leftIndex = 2 * $j + 1;
    $leftIndex = $leftIndex < $count ? $leftIndex : false;
    $indexQueue = [];
    if ($leftIndex) {
        $indexQueue[] = $leftIndex;
    }
    $rightIndex = 2 * $j + 2;
    $rightIndex = $rightIndex < $count ? $rightIndex : false;
    if ($rightIndex) {
        $indexQueue[] = $rightIndex;
    }
    while ($indexQueue) {
        $index = array_shift($indexQueue);
        $parentIndex = ceil($index / 2) - 1;
        if ($list[$parentIndex] < $list[$index]) {
            $list[$parentIndex] = $list[$parentIndex] - $list[$index];
            $list[$index] = $list[$parentIndex] + $list[$index];
            $list[$parentIndex] = $list[$index] - $list[$parentIndex];
            $leftIndex = 2 * $index + 1;
            $leftIndex = $leftIndex < $count ? $leftIndex : false;
            if ($leftIndex) {
                $indexQueue[] = $leftIndex;
            }
            $rightIndex = 2 * $index + 2;
            $rightIndex = $rightIndex < $count ? $rightIndex : false;
            if ($rightIndex) {
                $indexQueue[] = $rightIndex;
            }
        }
    }
}
for ($i = $count - 1; $i > 0; --$i) {
    $list[0] = $list[0] - $list[$i];
    $list[$i] = $list[0] + $list[$i];
    $list[0] = $list[$i] - $list[0];
    $indexQueue = [];
    $leftIndex = 1;
    $rightIndex = 2;
    if ($i > $leftIndex) {
        $indexQueue[] = $leftIndex;
    }
    if ($i > $rightIndex) {
        $indexQueue[] = $rightIndex;
    }
    while ($indexQueue) {
        $index = array_shift($indexQueue);
        $parentIndex = ceil($index / 2) - 1;
        if ($list[$parentIndex] < $list[$index]) {
            $list[$parentIndex] = $list[$parentIndex] - $list[$index];
            $list[$index] = $list[$parentIndex] + $list[$index];
            $list[$parentIndex] = $list[$index] - $list[$parentIndex];
            $leftIndex = 2 * $index + 1;
            if ($leftIndex < $i) {
                $indexQueue[] = $leftIndex;
            }
            $rightIndex = 2 * $index + 2;
            if ($rightIndex < $i) {
                $indexQueue[] = $rightIndex;
            }
        }
    }
}
var_dump($list);
die('asd');