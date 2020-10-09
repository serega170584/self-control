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

function sink($list, $i, $count)
{
    $queue = [$i];
    while ($queue) {
        $index = array_shift($queue);
        $ci = 2 * $index + 1;
        if ($ci > $count - 1) {
            continue;
        }
        if ($list[$ci] > $list[$index]) {
            $list = exch($list, $ci, $index);
            $queue[] = $ci;
        }
        $ci = 2 * $index + 2;
        if ($ci > $count - 1) {
            continue;
        }
        if ($list[$ci] > $list[$index]) {
            $list = exch($list, $ci, $index);
            $queue[] = $ci;
        }
    }
    return $list;
}

$count = rand(5, 15);
$list = [];
for ($i = 0; $i < $count; ++$i) {
    $list[] = rand(100, 1000);
}
$newCount = floor($count / 2) - 1;
for ($i = $newCount; $i >= 0; --$i) {
    $list = sink($list, $i, $count);
}
for ($i = $count - 1; $i > 0; --$i) {
    $list = exch($list, 0, $i);
    $list = sink($list, 0, $i);
}
var_dump($list);