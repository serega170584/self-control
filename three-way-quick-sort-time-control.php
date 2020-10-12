<?php
function exch($list, $i, $j)
{
    if ($i != $j) {
        $list[$i] = $list[$i] ^ $list[$j];
        $list[$j] = $list[$i] ^ $list[$j];
        $list[$i] = $list[$i] ^ $list[$j];
    }
    return $list;
}

$count = rand(25, 50);
$list = [];
for ($i = 0; $i < $count; ++$i) {
    $list[] = rand(100, 999);
}

$queue = [[0, $count - 1]];
while ($queue) {
    $el = array_shift($queue);
    $fromIndex = $el[0];
    $toIndex = $el[1];
    $t = $list[$fromIndex];
    $ml = $fromIndex;
    $mh = $fromIndex;
    $h = $el[1];
    while ($mh < $h) {
        if ($t < $list[$mh + 1]) {
            $list = exch($list, $mh + 1, $h--);
        } elseif ($t > $list[$mh + 1]) {
            $list = exch($list, $ml++, ++$mh);
        } else {
            ++$mh;
        }
    }
    if ($ml - 1 > $el[0]) {
        $queue[] = [$el[0], $ml - 1];
    }
    if ($mh + 1 < $el[1]) {
        $queue[] = [$mh + 1, $el[1]];
    }
}
var_dump($list);