<?php
$count = rand(5, 15);
$seq = 'abcdefghijklomnopqrstuvwxyz';
$list = [];
$maxLength = 0;
for ($i = 0; $i < $count; ++$i) {
    $length = rand(5, 15);
    $list[] = substr($seq, rand(5, 15), $length);
    $maxLength = $maxLength > $length ? $maxLength : $length;
}
function exch($list, $i, $j)
{
    if ($i != $j) {
        $el = $list[$i];
        $list[$i] = $list[$j];
        $list[$j] = $el;
    }
    return $list;
}

function charAt($str, $i)
{
    return $str[$i] ?? '';
}

$pos = 0;
$iterationQueue = [[0, $count]];
while ($pos < $maxLength) {
    $queue = [];
    $res = [];
    while ($iterationQueue) {
        $el = array_shift($iterationQueue);
        $fromIndex = $el[0];
        $curCount = $el[1];
        $counts = [];
        for ($i = $fromIndex; $i < $curCount; ++$i) {
            $char = charAt($list[$i], $pos);
            $code = ord($char);
            $counts[$code] = $counts[$code] ?? 0;
            ++$counts[$code];
        }
        ksort($counts);
        $charCount = 0;
        while ($curCharCount = current($counts)) {
            $code = key($counts);
            $counts[$code] = $charCount;
            $charCount += $curCharCount;
            next($counts);
        }
        $fromCounts = $counts;
        for ($i = $fromIndex; $i < $curCount; ++$i) {
            $res[$fromIndex + $counts[ord(charAt($list[$i], $pos))]++] = $list[$i];
        }
        foreach ($fromCounts as $index => $charCount) {
            $queue[] = [$fromIndex + $charCount, $fromIndex + $counts[$index]];
        }
    }
    $list = $res;
    ++$pos;
    $iterationQueue = $queue;
}
var_dump($list);
die('asd');