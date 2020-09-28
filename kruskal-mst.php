<?php
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
        $parentList[$j] = $i;
        $countList[$iRoot] += $jRootCount;
    }
}

$count = rand(5, 15);
for ($i = 0; $i < $count; ++$i) {
    for ($j = $i; $j < $count; ++$j) {
        $randInd = rand(0, $count - 1);
        $graph[$randInd][$i] = $graph[$i][$randInd] = rand(1, 1000);
    }
    unset($graph[$i][$i]);
}
var_dump($graph);
die('asd');