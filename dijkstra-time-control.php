<?php
$count = rand(5, 15);
$list = [];
for ($i = 0; $i < $count - 1; ++$i) {
    for ($j = $i; $j < $count; ++$j) {
        $list[$i][$j] = rand(100, 999);
    }
}
$distTo = array_fill(0, $count, INF);
$distTo[0] = 0;
$queue = [0];
while ($queue) {
    $v = array_shift($queue);
    $adj = $list[$v] ?? [];
    foreach ($adj as $w => $weight) {
        $weight = $distTo[$v] + $weight;
        if ($distTo[$w] > $weight) {
            $distTo[$w] = $weight;
            $queue[] = $w;
        }
    }
}
var_dump($list);
var_dump($distTo);