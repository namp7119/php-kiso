<?php

$num = 50;

if ($num > 50) {
    echo "50より大きい";
} elseif ($num < 50) {
    echo "50より小さい";
} else {
    echo "50";
}

/*
$num = 51;//50より大きい：OK
$num = 49;//50より小さい：OK
$num = 50;//50:OK
*/

