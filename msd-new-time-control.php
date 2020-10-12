<?php
function charAt($str, $i)
{
    return $str[$i] ?? '';
}

$count = rand(5, 15);
$list = [];
$maxLength = 0;
$seq = 'abcdefghijklomonopqrstuvwxyz';
for ($i = 0; $i < $count; ++$i) {
    $length = rand(5, 15);
    $maxLength = $maxLength > $length ? $maxLength : $length;
    $list[] = substr($seq, rand(5, 15), $length);
}
$pos = 0;
$queue = [[0, $count]];
while ($pos < $maxLength) {
    $res = [];
    $intQueue = [];
    while ($queue) {
        $int = array_shift($queue);
        $fromIndex = $int[0];
        $toCount = $int[1];
        $counts = [];
        for ($i = $fromIndex; $i < $toCount; ++$i) {
            $char = charAt($list[$i], $pos);
            $code = ord($char);
            $counts[$code] = $counts[$code] ?? 0;
            ++$counts[$code];
        }
        ksort($counts);
        $curCount = 0;
        while ($nextCount = current($counts)) {
            $code = key($counts);
            $counts[$code] = $curCount;
            $curCount += $nextCount;
            next($counts);
        }
        $fromIndexes = $counts;
        for ($i = $fromIndex; $i < $toCount; ++$i) {
            $char = charAt($list[$i], $pos);
            $code = ord($char);
            $res[$fromIndex + $counts[$code]++] = $list[$i];
        }
        foreach ($fromIndexes as $code => $ind) {
            $intQueue[] = [$fromIndex + $ind, $fromIndex + $counts[$code]];
        }
    }
    $list = $res;
    $queue = $intQueue;
    ++$pos;
}
ksort($list);
var_dump($list);