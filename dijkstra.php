<?php
$count = rand(5, 15);
$list = [];
$queue = [];
for ($i = 0; $i < $count - 1; ++$i) {
    for ($j = $i + 1; $j < $count; ++$j) {
        $list[$i][$j] = rand(1, 1000);
    }
}
$distTo = array_fill(0, $count, INF);
$v = 0;
$distTo[$v] = 0;
$queue = [$v => 0];
$path = [];
while ($queue) {
    $v = key($queue);
    array_shift($queue);
    $vertexWeight = $distTo[$v];
    $weights = $list[$v];
    foreach ($weights as $vertex => $weight) {
        $vertexWeight = $distTo[$v] + $weight;
        if ($distTo[$vertex] > $vertexWeight) {
            $distTo[$vertex] = $vertexWeight;
            $queue[$vertex] = $vertexWeight;
            $path[$vertex] = $v;
        }
    }
    asort($queue);
}
var_dump($distTo);
var_dump($path);