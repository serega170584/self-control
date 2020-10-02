<?php
$count = rand(5, 15);
$list = [];
for ($i = 0; $i < $count - 1; ++$i) {
    for ($j = $i + 1; $j < $count; ++$j) {
        $list[$i][$j] = rand(1, 1000);
    }
}
$distTo = array_fill(0, $count, INF);
$distTo[0] = 0;
$queue = [0];
$onQ = array_fill(0, $count, false);
$onQ[0] = true;
$path = [];
while ($queue) {
    $v = array_shift($queue);
    $onQ[$v] = false;
    $weights = $list[$v];
    foreach ($weights as $vertex => $weight) {
        $vertexWeight = $distTo[$v] + $weight;
        if ($distTo[$vertex] > $vertexWeight) {
            $distTo[$vertex] = $vertexWeight;
            $path[$vertex] = $v;
            if (!$onQ[$vertex]) {
                $queue[] = $vertex;
                $onQ[$vertex] = true;
            }
        }
    }
}
var_dump($path);
var_dump($distTo);