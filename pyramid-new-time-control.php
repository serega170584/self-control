<?php
$count = rand(5, 15);
function exch($list, $i, $j)
{
    if ($i != $j) {
        $list[$i] = $list[$i] ^ $list[$j];
        $list[$j] = $list[$i] ^ $list[$j];
        $list[$i] = $list[$i] ^ $list[$j];
    }
    return $list;
}

function sink($list, $i, $count)
{
    $queue = [$i];
    while ($queue) {
        $ind = array_shift($queue);
        $ci = 2 * $ind + 1;
        if ($ci >= $count) {
            continue;
        }
        if ($list[$ci] > $list[$ind]) {
            $list = exch($list, $ci, $ind);
            $queue[] = $ci;
        }
        $ci = 2 * $ind + 2;
        if ($ci >= $count) {
            continue;
        }
        if ($list[$ci] > $list[$ind]) {
            $list = exch($list, $ci, $ind);
            $queue[] = $ci;
        }
    }
    return $list;
}

$list = [];
for ($i = 0; $i < $count; ++$i) {
    $list[$i] = rand(100, 999);
}

$pyrIndex = floor($count / 2) - 1;
for ($i = $pyrIndex; $i >= 0; --$i) {
    $list = sink($list, $i, $count);
}
var_dump($list);
for ($i = $count - 1; $i > 0; --$i) {
    $list = exch($list, $i, 0);
    $list = sink($list, 0, $i);
}
var_dump($list);