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

$count = rand(10, 100);
$list = [];
for ($i = 0; $i < $count; ++$i) {
    $list[] = rand(10, 15);
}

$queue = [[0, $count - 1]];
while ($queue) {
    $el = array_shift($queue);
    $ml = $el[0];
    $mh = $el[0];
    $l = $ml + 1;
    $h = $el[1];
    $mp = $list[$ml];
    while ($mh < $h) {
        if ($list[$mh] < $list[$mh + 1]) {
            $list = exch($list, $mh + 1, $h--);
        } elseif ($list[$mh] > $list[$mh + 1]) {
            $list = exch($list, $ml++, ++$mh);
        } else {
            ++$mh;
        }
    }
    if ($ml > $el[0]) {
        $queue[] = [$el[0], $ml - 1];
    }
    if ($mh < $el[1]) {
        $queue[] = [$mh + 1, $el[1]];
    }
}
var_dump($list);