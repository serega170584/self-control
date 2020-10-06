<?php
$seq = 'abcdefghigklmnopqarstuvwxyz';
$wordCount = rand(5, 15);
$list = [];
for ($i = 0; $i < $wordCount; ++$i) {
    $length = rand(5, 15);
    $start = rand(5, 20);
    $list[] = substr($seq, $start, $length);
}
$counts = [];
for ($i = 0; $i < $wordCount; ++$i) {
    $code = ord($list[$i]);
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
    $code = key($counts);
    $count += $nextCount;
}

$sortedList = [];
foreach ($list as $word) {
    $sortedList[$counts[ord($word)]++] = $word;
}
ksort($sortedList);