<?php
$start_num = 1;
$max_rows = 5;

for ($i =0; $i < $max_rows; $i++) {
    for ($s = 1; $s <= ($max_rows - $i - 1); $s++) {
        echo " ";
    }

    $current_min = $start_num + $i;
    for ($j = $start_num; $j <= $current_min; $j++) { echo $j;}
    for ($k = $current_min - 1; $k >= $start_num; $k-- ) { echo $k;}
    echo "\n";
}

for ($i = $max_rows - 2; $i >= 0; $i--) {
    for ($s = 1; $s <= ($max_rows - $i -1); $s++) {
        echo " ";
    }

    $current_min = $start_num + $i;
    for ($j = $start_num; $j<= $current_min; $j++) { echo $j;}
    for ($k = $current_min -1; $k >= $start_num; $k--) { echo $k;}
    echo "\n";
}