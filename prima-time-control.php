<?php
$count = rand(5, 5);
$list = [];
for ($i = 0; $i < $count - 1; ++$i) {
    for ($j = $i + 1; $j < $count; ++$j) {
        $list[$i][$j] = $list[$j][$i] = rand(100, 1000);
    }
}
$dist = array_fill(0, $count, INF);
$queue[0] = 0;
$dist[0] = 0;
$marked = array_fill(0, $count, false);
while ($queue) {
    $v = key($queue);
    $el = current($queue);
    unset($queue[$v]);
    $marked[$v] = true;
    foreach ($list[$v] as $w => $weight) {
        if ($marked[$w]) {
            continue;
        }
        if ($dist[$w] > $weight) {
            $dist[$w] = $weight;
            $queue[$w] = $weight;
        }
    }
    asort($queue);
}
var_dump($list);
var_dump($dist);