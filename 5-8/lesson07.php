<?php

$numbers = [2, 9, 7, 5, 8, 1, 3, 4, 6];

$target = 1;

$found = false;
$count = 0;

foreach ($numbers as $index => $value) {
    $count++;

    if ($value === $target) {
        echo "探索回数{$count}回\n";
        echo "要素はインデックス{$index}にあります。\n";
        $found = true;
        break;
    }
}
    
if (!$found) {
    echo "探索回数{$count}回\n";
    echo "値{$target}は見つかりませんでした。";
}
