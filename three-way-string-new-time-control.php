<?php
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

$count = rand(5, 15);
$maxLength = 0;
$list = [];
$seq = 'abcdefghijklmnopqrstuvwxyz';
for ($i = 0; $i < $count; ++$i) {
    $length = rand(5, 15);
    $maxLength = $maxLength > $length ? $maxLength : $length;
    $list[] = substr($seq, rand(5, 15), $length);
}
$queue = [[0, $count - 1]];
$pos = 0;
while ($pos != $maxLength) {
    $itQueue = [];
    while ($queue) {
        $el = array_shift($queue);
        $l = $el[0] + 1;
        $mh = $ml = $el[0];
        $h = $el[1];
        $t = $list[$el[0]];
        $tCode = ord(charAt($t, $pos));
        while ($mh < $h) {
            $code = ord(charAt($list[$mh + 1], $pos));
            if ($tCode < $code) {
                $list = exch($list, $mh + 1, $h--);
            } elseif ($tCode > $code) {
                $list = exch($list, $ml++, ++$mh);
            } else {
                ++$mh;
            }
        }
        if ($mh > $ml) {
            $itQueue[] = [$ml, $mh];
        }
        if ($ml - 1 > $el[0]) {
            $queue[] = [$el[0], $ml - 1];
        }
        if ($mh + 1 < $el[1]) {
            $queue[] = [$mh + 1, $el[1]];
        }
    }
    ++$pos;
    $queue = $itQueue;
}
var_dump($list);