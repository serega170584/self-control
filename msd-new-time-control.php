<?php
function charAt($str, $i)
{
    return $str[$i] ?? '';
}

$count = rand(5, 15);
$maxLength = 0;
$seq = 'abcdefghijklmnopqrstuvwxyz';
$list = [];
for ($i = 0; $i < $count; ++$i) {
    $length = rand(5, 15);
    $maxLength = $maxLength > $length ? $maxLength : $length;
    $list[$i] = substr($seq, rand(5, 15), $length);
}

$queue = [[0, $count]];
$pos = 0;
while ($pos < $maxLength) {
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
        foreach ($fromIndexes as $code => $fromIndexCount) {
            $itQueue[] = [$fromIndex + $fromIndexCount, $fromIndex + $counts[$code]];
        }
    }
    $list = $res;
    $queue = $itQueue;
    ++$pos;
}
var_dump($list);