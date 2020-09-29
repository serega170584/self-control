<?php
$count = rand(5, 15);
$graph = [];
for ($i = 0; $i < $count; ++$i) {
    for ($j = $i; $j < $count; ++$j) {
        $randInd = rand(0, $count - 1);
        $graph[$randInd][$i] = $graph[$i][$randInd] = rand(1, 1000);
    }
    unset($graph[$i][$i]);
}
$edges = getEdges($graph);


$parentList = range(0, $count - 1);
$countList = array_fill(0, $count, 1);
$mst = [];
while ($list = current($edges)) {
    $weight = key($edges);
    while ($edge = current($list)) {
        if (!isConnected($parentList, $edge[0], $edge[1])) {
            connect($parentList, $edge[0], $edge[1], $countList);
            $mst[$edge[0]][$edge[1]] = $weight;
        }
        next($list);
    }
    next($edges);
}
var_dump($count);
var_dump($mst);
die('asd');

function getEdges($graph)
{
    $count = count($graph);
    $edges = [];
    for ($i = 0; $i < $count; ++$i) {
        $weights = $graph[$i];
        while ($weight = current($weights)) {
            $vertex = key($weights);
            $edges[$weight][] = [$i, $vertex];
            next($weights);
        }
    }
    ksort($edges);
    return $edges;
}

function getRoot($parentList, $i)
{
    while ($parentList[$i] != $i) {
        $i = $parentList[$i];
    }
    return $i;
}

function connect(&$parentList, $i, $j, &$countList)
{
    $iRoot = getRoot($parentList, $i);
    $jRoot = getRoot($parentList, $j);
    $iRootCount = $countList[$iRoot];
    $jRootCount = $countList[$jRoot];
    if ($iRootCount > $jRootCount) {
        $parentList[$jRoot] = $iRoot;
        $countList[$iRoot] += $jRootCount;
    } else {
        $parentList[$iRoot] = $jRoot;
        $countList[$jRoot] += $iRootCount;
    }
}

function isConnected($parentList, $i, $j)
{
    return getRoot($parentList, $i) == getRoot($parentList, $j);
}

