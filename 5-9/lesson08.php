<?php

$original_arr = [2, 9, 7, 5, 8, 1, 3, 4, 6];
$target = 4;

$target_arr = $original_arr;
asort($target_arr);

$values = array_values($target_arr);
$indices = array_keys($target_arr);

$low = 0;
$high = count($values) - 1;
$search_count = 0;
$found_index = -1;

while ($low <= $high) {
    $search_count++;
    $mid =floor(($low + $high) / 2);
    $guess = $values[$mid];

    if ($guess == $target) {
        $found_index = $indices[$mid];
        break;
    }
    if($guess > $target) {
        $high = $mid - 1;
    } else {
        $low = $mid + 1;
    }
}

echo "要素{$target}は元の配列のインデックス{$found_index}に見つかりました\n";
echo "探索回数: {$search_count}回\n";
?>



