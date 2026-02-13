<?php

$towers = [
    'A' => [3, 2, 1],
    'B' => [],
    'C' => []
];

echo "⬛︎実行前\n";
print_r($towers);

function hanoi_sim($n, $source_key, $target_key, $helper_key, &$towers) {
    if ($n === 1) {
        $disk = array_pop($towers[$source_key]);
        array_push($towers[$target_key], $disk);
        echo "{$source_key} から {$target_key} に移動\n";
        return;
    }

    hanoi_sim($n - 1, $source_key, $helper_key, $target_key, $towers);

    hanoi_sim(1, $source_key, $target_key, $helper_key, $towers);

    hanoi_sim($n - 1, $helper_key, $target_key, $source_key, $towers);
}

hanoi_sim(3, 'A', 'C', 'B', $towers);

echo "⬛︎実行後\n";
print_r($towers);
