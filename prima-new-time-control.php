<?php
$count = rand(5, 15);
$list = [];
for ($i = 0; $i < $count - 1; ++$i) {
    for ($j = $i + 1; $j < $count; ++$j) {
        $list[$i][$j] = $list[$j][$i] = rand(100, 999);
    }
}
$distTo = array_fill(0, $count, INF);
$distTo[0] = 0;
$marked = array_fill(0, $count, false);
$queue = [0];
while ($queue) {
    $v = key($queue);
    $weight = current($queue);
    unset($queue[$v]);
    $marked[$v] = true;
    foreach ($list[$v] as $w => $wWeight) {
        if ($marked[$w]) {
            continue;
        }
        if ($wWeight < $distTo[$w]) {
            $distTo[$w] = $wWeight;
            $queue[$w] = $wWeight;
        }
    }
    asort($queue);
}
var_dump($list);
var_dump($distTo);