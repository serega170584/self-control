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
    while ($intervalCount = array_shift($intervalCounts)) {
        $toIndex = $intervalCount[1];
        $fromIndex = $intervalCount[0];
        if ($toIndex - $fromIndex == 1) {
            continue;
        }
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
            next($counts);
            $nextCount = key($counts);
            $charCount = $counts[$nextCount] ?? 0;
            $intervalCounts[] = [$fromIndex + $curCount, $fromIndex + $nextCount];
            $totalCounts += $charCount;
        }
        ksort($counts);
        for ($i = $fromIndex; $i < $toIndex; ++$i) {
            $char = charAt($pos, $list[$i]);
            $code = ord($char);
            $res[$counts[$code]++] = $list[$i];
        }
        var_dump($res);
        die('asd');
    }
    $list = $res;
    ++$pos;
}
var_dump($list);













