<?php

$arr = [5, 2, 7, 9, 8, 1, 3, 6, 4];
$n = count($arr);
$count = 0;



for ($i = 0; $i < $n - 1; $i++) {
    for ($j = 0; $j < $n - 1 - $i; $j++) {
        if ($arr[$j] > $arr[$j + 1]) {
            $temp = $arr[$j];
            $arr[$j] = $arr[$j + 1];
            $arr[$j + 1] = $temp;

            $count++;
            echo "入れ替え{$count}回目\n";
            print_r($arr);
        }
    }
}

echo "\n結果\n";
print_r($arr);
?>