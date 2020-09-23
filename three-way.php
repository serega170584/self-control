<?php
$count = rand(10, 100);
$list = [];
for ($i = 0; $i < $count; ++$i) {
    $list[$i] = rand(1, 1000);
}
$partFirstIndex = 0;
$partLastIndex = 0;
$firstIndex = 1;
$lastIndex = $count - 1;
$indexQueue = [];
$lowBorder = 0;
$highBorder = $count - 1;
while ($partLastIndex < $lastIndex) {
    if ($list[$partLastIndex + 1] == $list[$partLastIndex]) {
        ++$partLastIndex;
    } elseif ($list[$partLastIndex + 1] < $list[$partLastIndex]) {
        $list[$partLastIndex + 1] = $list[$partLastIndex + 1] - $list[$partFirstIndex];
        $list[$partFirstIndex] = $list[$partFirstIndex] + $list[$partLastIndex + 1];
        $list[$partLastIndex + 1] = $list[$partFirstIndex] - $list[$partLastIndex + 1];
        ++$partFirstIndex;
        ++$partLastIndex;
    } else {
        if ($lastIndex != $partLastIndex + 1) {
            $list[$partLastIndex + 1] = $list[$partLastIndex + 1] - $list[$lastIndex];
            $list[$lastIndex] = $list[$lastIndex] + $list[$partLastIndex + 1];
            $list[$partLastIndex + 1] = $list[$lastIndex] - $list[$partLastIndex + 1];
        }
        --$lastIndex;
    }
}
if ($lowBorder < $partFirstIndex - 1) {
    $indexQueue[] = [$lowBorder, $partFirstIndex - 1];
}
if ($highBorder > $partLastIndex + 1) {
    $indexQueue[] = [$partLastIndex + 1, $highBorder];
}
while ($indexQueue) {
    $indexEl = array_shift($indexQueue);
    $partFirstIndex = $indexEl[0];
    $partLastIndex = $indexEl[0];
    $firstIndex = $partFirstIndex + 1;
    $lastIndex = $indexEl[1];
    $lowBorder = $indexEl[0];
    $highBorder = $lastIndex;
    while ($partLastIndex < $lastIndex) {
        if ($list[$partLastIndex + 1] == $list[$partLastIndex]) {
            ++$partLastIndex;
        } elseif ($list[$partLastIndex + 1] < $list[$partLastIndex]) {
            $list[$partLastIndex + 1] = $list[$partLastIndex + 1] - $list[$partFirstIndex];
            $list[$partFirstIndex] = $list[$partFirstIndex] + $list[$partLastIndex + 1];
            $list[$partLastIndex + 1] = $list[$partFirstIndex] - $list[$partLastIndex + 1];
            ++$partFirstIndex;
            ++$partLastIndex;
        } else {
            if ($lastIndex != $partLastIndex + 1) {
                $list[$partLastIndex + 1] = $list[$partLastIndex + 1] - $list[$lastIndex];
                $list[$lastIndex] = $list[$lastIndex] + $list[$partLastIndex + 1];
                $list[$partLastIndex + 1] = $list[$lastIndex] - $list[$partLastIndex + 1];
            }
            --$lastIndex;
        }
    }
    if ($lowBorder < $partFirstIndex - 1) {
        $indexQueue[] = [$lowBorder, $partFirstIndex - 1];
    }
    if ($highBorder > $partLastIndex + 1) {
        $indexQueue[] = [$partLastIndex + 1, $highBorder];
    }
}
var_dump($list);
die('asd');