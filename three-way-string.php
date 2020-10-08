<?php
function charAt($str, $pos)
{
    return $str[$pos] ?? '';
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

$count = rand(90, 100);
$list = [];
$seq = 'abcdefghijklmnopqrstuvwxyz';
$maxLength = 0;
for ($i = 0; $i < $count; ++$i) {
    $length = rand(5, 15);
    $maxLength = $maxLength > $length ? $maxLength : $length;
    $list[] = substr($seq, rand(5, 15), $length);
}
$queue = [[0, $count - 1]];
$pos = 0;
while ($pos < $maxLength) {
    $sortQueue = $queue;
    $queue = [];
    while ($sortQueue) {
        $el = array_shift($sortQueue);
        $ml = $el[0];
        $h = $el[1];
        $l = $ml + 1;
        $mh = $ml;
        $mp = charAt($list[$ml], $pos);
        while ($mh < $h) {
            if (ord($mp) < ord(charAt($list[$mh + 1], $pos))) {
                $list = exch($list, $mh + 1, $h--);
            } elseif (ord($mp) > ord(charAt($list[$mh + 1], $pos))) {
                $list = exch($list, $ml++, ++$mh);
            } else {
                ++$mh;
            }
        }
        $queue[] = [$ml, $mh];
        if ($ml > $el[0]) {
            $sortQueue[] = [$el[0], $ml - 1];
        }
        if ($mh < $el[1]) {
            $sortQueue[] = [$mh + 1, $el[1]];
        }
    }
    ++$pos;
}
var_dump($list);
die('asd');
