<?php

for ($year = 1980; $year <= 2080; $year++) {
    if (($year % 4 === 0 && $year % 100 !== 0) || ($year % 400 ===0)) {
        echo "{$year}年はうるう年です。 \n";
    } else {
        echo "{$year}年 \n";
    }
}
?>
