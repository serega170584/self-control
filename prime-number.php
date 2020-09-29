<?php
$n = rand(1, 1000);
$list = [2];
for ($i = 3; $i < $n; ++$i) {
    $primeNumber = $i;
    reset($list);
    while ($el = current($list)) {
        if (!($i % $el)) {
            $primeNumber = false;
            break;
        }
        next($list);
    }
    if ($primeNumber) {
        $list[] = $primeNumber;
    }
}
var_dump($n);
var_dump($list);