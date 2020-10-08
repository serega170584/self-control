<?php
function charAt($str, $pos)
{
    return $str[$pos] ?? '';
}

$pos = 0;
$count = rand(5, 15);
$seq = 'abcdefghijklmnopqrstuvwxyz';
$list = [];
$maxLength = 0;
for ($i = 0; $i < $count; ++$i) {
    $length = rand(5, 15);
    $start = rand(0, 15);
    $list[] = substr($seq, $start, $length);
    $maxLength = $maxLength < $length ? $length : $maxLength;
}
$intervalCounts = [[0, $count]];
while ($intervalCounts) {
    $res = [];
    if ($pos == $count) {
        break;
    }
    $iterationIntervalCounts = [];
    while ($intervalCount = array_shift($intervalCounts)) {
        $toIndex = $intervalCount[1];
        $fromIndex = $intervalCount[0];
        $counts = [];
        for ($i = $fromIndex; $i < $toIndex; ++$i) {
            $char = charAt($list[$i], $pos);
            $code = ord($char);
            $counts[$code] = $counts[$code] ?? 0;
            ++$counts[$code];
        }
        ksort($counts);
        $totalCounts = current($counts);
        while ($charCount = current($counts)) {
            $curCount = $totalCounts - $counts[key($counts)];
            $counts[key($counts)] = $curCount;
            $iterationIntervalCounts[] = [$fromIndex + $curCount, $fromIndex + $totalCounts];
            next($counts);
            $nextCount = key($counts);
            $charCount = $counts[$nextCount] ?? 0;
            $totalCounts += $charCount;
        }
        ksort($counts);
        for ($i = $fromIndex; $i < $toIndex; ++$i) {
            $char = charAt($list[$i], $pos);
            $code = ord($char);
            $res[$fromIndex + $counts[$code]++] = $list[$i];
        }
        ksort($res);
    }
    $intervalCounts = $iterationIntervalCounts;
    $list = $res;
    ++$pos;
}
var_dump($list);













