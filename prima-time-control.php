<?php
$count = rand(5, 15);
$list = [];
for ($i = 0; $i < $count; ++$i) {
    for ($j = 0; $j < $count; ++$j) {
        $list[$i][$j] = rand(100, 999);
    }
}
$marked = array_fill(0, $count, false);
$distTo = array_fill(0, $count, INF);
$distTo[0] = 0;
$queue[0] = 0;
while ($queue) {
    $v = key($queue);
    $weight = current($queue);
    unset($queue[$v]);
    $marked[$v] = true;
    $adj = $list[$v] ?? [0];
    foreach ($adj as $w => $wWeight) {
        if ($marked[$w]) continue;
        if ($distTo[$w] > $wWeight) {
            $distTo[$w] = $wWeight;
            $queue[$w] = $wWeight;
        }
    }
    asort($queue);
}
var_dump($list);
var_dump($distTo);