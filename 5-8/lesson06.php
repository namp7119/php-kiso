<?php

$arr = [4, 5, 1, 3, 2, 9, 6, 8, 7];

echo "実行したいソートを入力してください:\n";
echo "(SELECT / INSERT / MERGE / QUICK)\n";
echo "入力 > ";

$input = trim(fgets(STDIN));
$mode = strtoupper($input);

echo "\n--- 実行開始 ---\n";

switch ($mode) {
    case 'SELECT':
        echo "【選択ソートを実行】\n";
        $result = selectionSort($arr);
        break;
    
    case 'INSERT':
        echo "【挿入ソートを実行】\n";
        $result = insertionSort($arr);
        break;

    case 'MERGE':
        echo "【マージソートを実行】\n";
        $result = mergeSort($arr);
        break;

    case 'QUICK':
        echo "【クイックソートを実行】\n";
        $result = quickSort($arr);
        break;
        
    default:
        echo "エラー：指定されたソートは存在しません。\n";
        exit;    

}

echo "\n--- 結果 ---\n";
print_r($result);

function selectionSort($arr) {
    $n = count($arr);    
    for ($i = 0; $i < $n - 1; $i++) {
        $min_idx = $i;
        for ($j = $i +1; $j < $n; $j++) {
            if ($arr[$j] < $arr[$min_idx]) $min_idx = $j;
        }
        $temp = $arr[$i];
        $arr[$i] = $arr[$min_idx];
        $arr[$min_idx] = $temp;

        echo "ステップ " . ($i + 1) . "回目:\n";
        print_r($arr);
    }
    return $arr;        
}


function insertionSort($arr) {
    $n = count($arr);
    for ($i = 1; $i < $n; $i++) {
        $v = $arr[$i];
        $j = $i - 1;
        while ($j >=0 && $arr[$j] > $v) {
            $arr[$j + 1] = $arr[$j];
            $j--;
        }
        $arr[$j + 1] = $v;

        echo "{$i}回目:\n";
        print_r($arr);
    }
    return $arr;
}


function mergeSort($arr) {
    if (count($arr) <= 1) return $arr;
    $mid = floor(count($arr) / 2);
    $left = mergeSort(array_slice($arr, 0,$mid));
    $right = mergeSort(array_slice($arr, $mid));

    $res = merge($left, $right);
    echo "マージ結果: " . implode(', ', $res) . "\n";
    return $res;
}

function merge($left, $right) {
    $res = [];
    while (count($left) > 0 && count($right) > 0) {
        if ($left[0] <= $right[0]) array_push($res, array_shift($left));
        else array_push($res, array_shift($right));
    }
    return array_merge($res, $left, $right);
}


function quickSort($arr) { 
    if (count($arr) < 2) return $arr;
    $pivot = $arr[0];
    $left = $right = [];
    for ($i = 1; $i < count($arr); $i++) {
        if ($arr[$i] < $pivot) $left[] = $arr[$i];
        else $right[] = $arr[$i];
    }
    echo "分割中: [" . implode(', ', $left) . "] < $pivot < [" . implode(', ', $right) . "]\n";
    return array_merge(quickSort($left), [$pivot], quickSort($right));
}