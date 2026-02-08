<?php

$start_num = 5;
$rows = 5;

for ($i = 0; $i < $rows; $i++) {
    for ($s = 1; $s <= ($rows - $i - 1); $s++) {
        echo " ";
    }

    $current_min = $start_num - $i;

    for ($j = $start_num; $j >= $current_min; $j--){
        echo $j;
    }

    for ($k = $current_min + 1; $k <= $start_num; $k++) {
        echo $k;
    }

    echo "\n";
}


