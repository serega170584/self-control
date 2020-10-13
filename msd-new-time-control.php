<?php
function charAt($str, $i)
{
    return $str[$i] ?? '';
}

$maxLength = 0;
$seq = 'abcdefghijklmnopqrstuvwxyz';
$list = [];
$count = rand(5, 15);
for ($i = 0; $i < $count; ++$i) {
    $length = rand(5, 15);
    $maxLength = $maxLength > $length ? $maxLength : $length;
    $list[] = substr($seq, rand(5, 15), $length);
}
$pos = 0;
$queue = [[0, $count]];
while ($pos != $maxLength) {
    $res = [];
    $itQueue = [];
    while ($queue) {
        $el = array_shift($queue);
        $fromIndex = $el[0];
        $toCount = $el[1];
        $counts = [];
        for ($i = $fromIndex; $i < $toCount; ++$i) {
            $char = charAt($list[$i], $pos);
            $code = ord($char);
            $counts[$code] = $counts[$code] ?? 0;
            ++$counts[$code];
        }
        ksort($counts);
        $curCount = 0;
        while ($curItCount = current($counts)) {
            $code = key($counts);
            $counts[$code] = $curCount;
            $curCount += $curItCount;
            next($counts);
        }
        $fromIndexes = $counts;
        for ($i = $fromIndex; $i < $toCount; ++$i) {
            $char = charAt($list[$i], $pos);
            $code = ord($char);
            $res[$fromIndex + $counts[$code]++] = $list[$i];
        }
        foreach ($fromIndexes as $code => $itCount) {
            $itQueue[] = [$fromIndex + $itCount, $fromIndex + $counts[$code]];
        }
    }
    $queue = $itQueue;
    $list = $res;
    ++$pos;
}
var_dump($list);
