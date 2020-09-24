<?php
$count = rand(10, 100);
$list = [];
for ($i = 0; $i < $count; ++$i) {
    $list[$i] = rand(1, 1000);
}
$indexQueue = [[0, $count - 1]];
while ($indexQueue) {
    $el = array_shift($indexQueue);
    $lb = $el[0];
    $lp = $el[0];
    $rp = $el[0];
    $hb = $el[1];
    $s = $list[$el[0]];
    while ($rp != $hb) {
        if ($s == $list[$rp + 1]) {
            ++$rp;
        } elseif ($s < $list[$rp + 1]) {
            $list = exch($list, $rp + 1, $hb);
            --$hb;
        } else {
            $list = exch($list, $lp, $rp + 1);
            ++$lp;
            ++$rp;
        }
    }
    if ($lb < $lp - 1) {
        $indexQueue[] = [$lb, $lp - 1];
    }
    if ($rp + 1 < $el[1]) {
        $indexQueue[] = [$rp + 1, $el[1]];
    }
}
var_dump($list);

function exch($list, $i, $j)
{
    if ($list[$i] != $list[$j]) {
        $list[$i] = $list[$i] - $list[$j];
        $list[$j] = $list[$i] + $list[$j];
        $list[$i] = $list[$j] - $list[$i];
    }
    return $list;
}