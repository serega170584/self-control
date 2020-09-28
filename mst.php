<?php
$count = rand(5, 15);
$graph = [];
for ($i = 0; $i < $count; ++$i) {
    $neighboursCount = rand(1, $count);
    for ($j = 0; $j < $neighboursCount; ++$j) {
        $v = rand(0, $count - 1);
        while ($v == $i) {
            $v = rand(0, $count - 1);
        }
        $weight = $graph[$i][$v] ?? false;
        if (!$weight) {
            $graph[$v][$i] = $graph[$i][$v] = rand(1, 1000);
        }
    }
}
$mst = [];
$marked = array_fill(0, $count, false);
$v = 0;
$marked[$v] = true;
$distTo = array_fill(0, $count, INF);
$queue = $graph[$v];
$distTo = generateDistTo($distTo, $queue);
asort($queue);
while ($queue) {
    $vi = key($queue);
    $weight = array_shift($queue);
    $mst[$v][$vi] = $weight;
    $queue = $graph[$vi];
    $v = $vi;
    $marked[$vi] = true;
    foreach ($queue as $vi => $weight) {
        if ($marked[$vi]) {
            unset($queue[$vi]);
            continue;
        }
        if ($distTo[$vi] > $weight) {
            $distTo[$vi] = $weight;
        }
    }
    asort($queue);
}
var_dump($graph);
var_dump($mst);

function generateDistTo($distTo, $queue)
{
    foreach ($distTo as $vertex => $weight) {
        $queueWeight = $queue[$vertex] ?? INF;
        if ($distTo[$vertex] > $queueWeight) {
            $distTo[$vertex] = $queueWeight;
        }
    }
    return $distTo;
}
