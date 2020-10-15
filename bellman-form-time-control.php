<?php
$count = rand(5, 15);
$graph = [];
for ($i = 0; $i < $count - 1; ++$i) {
    for ($j = $i + 1; $j < $count; ++$j) {
        $graph[$i][$j] = rand(100, 900);
    }
}
$distTo = array_fill(0, $count, INF);
$distTo[0] = 0;
$queue = [0];
while ($queue) {
    $v = array_shift($queue);
    $adj = $graph[$v] ?? [];
    foreach ($adj as $w => $weight) {
        $weight = $distTo[$v] + $weight;
        if ($weight < $distTo[$w]) {
            $distTo[$w] = $weight;
            $queue[] = $w;
        }
    }
}
var_dump($distTo);