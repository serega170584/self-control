<?php
$count = rand(5, 15);
$seq = 'abcdefghijklmnopqrstuvwxyz';
$list = [];
$length = 10;
for ($i = 0; $i < $count; ++$i) {
    $list[$i] = substr($seq, rand(5, 15), $length);
}

$ci = $length - 1;
while ($ci >= 0) {
    $counts = [];
    for ($i = 0; $i < $count; ++$i) {
        $code = ord($list[$i][$ci]);
        $counts[$code] = $counts[$code] ?? 0;
        ++$counts[$code];
    }
    ksort($counts);
    $code = key($counts);
    $count = 0;
    while ($code) {
        $nextCount = $counts[$code];
        $counts[$code] = $count;
        next($counts);
        $count += $nextCount;
        $code = key($counts);
    }
    $sortedList = [];
    for ($i = 0; $i < $count; ++$i) {
        $sortedList[$counts[ord($list[$i][$ci])]++] = $list[$i];
    }
    ksort($sortedList);
    $list = array_values($sortedList);
    --$ci;
}
var_dump($list);