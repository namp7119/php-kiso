<?php

$max = 4;

for ($i = $max; $i >= 1; $i--) {
    for ($s = 1; $s <= ($max - $i); $s++) {
        echo " ";
    }

    for ($j = 1; $j <= $i; $j++){
        echo $j;
    }

    for ($k = $i - 1; $k >= 1; $k--) {
        echo $k;
    }

    echo "\n";
}



