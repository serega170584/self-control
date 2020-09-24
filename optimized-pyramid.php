<?php
$count = rand(10, 100);
$list = [];
for ($i = 0; $i < $count; ++$i) {
    $list[$i] = rand(1, 1000);
}
$list = sink($list, $count);
for ($i = $count - 1; $i > 0; --$i) {
    $list = exch($list, 0, $i);
    $list = sink($list, $i);
}

function exch($list, $i, $j)
{
    $list[$i] = $list[$i] - $list[$j];
    $list[$j] = $list[$j] + $list[$i];
    $list[$i] = $list[$j] - $list[$i];
    return $list;
}

function fillIndexQueue($queue, $ci, $pi, $count, &$list)
{
    if ($list[$ci] > $list[$pi]) {
        $list = exch($list, $ci, $pi);
        $indexes = [2 * $ci + 1, 2 * $ci + 2];
        foreach ($indexes as $index) {
            if ($index < $count) {
                $queue[] = $index;
            }
        }
    }
    return $queue;
}

function sink($list, $count)
{
    for ($i = $count - 1; $i > 0; --$i) {
        $parentIndex = ceil($i / 2) - 1;
        $indexQueue = [];
        while ($parentIndex !== false) {
            $indexes = [2 * $parentIndex + 1, 2 * $parentIndex + 2];
            foreach ($indexes as $index) {
                if ($index < $count) {
                    $indexQueue = fillIndexQueue($indexQueue, $index, $parentIndex, $count, $list);
                }
            }
            $parentIndex = $indexQueue ? ceil(array_shift($indexQueue) / 2) - 1 : false;
        }
    }
    return $list;
}