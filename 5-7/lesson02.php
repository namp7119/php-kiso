<?php

$stack = [];

while (true) {
    echo "\n⬜︎モード選択 (1:Push, 2:Pop, 3:Peek, 4:IsEmpty, その他:終了): ";
   
    $mode = trim(fgets(STDIN));

    if ($mode == '1') {
            echo "「データ入力」をしてください: ";
            $data =trim(fgets(STDIN));
            array_push($stack, $data);
            echo "結果: {$data}をPushしました。 \n";

        } elseif ($mode == '2') {
            if (empty($stack)) {
                echo "結果: empty (取り出すデータがありません）\n";
            } else {
                $popped = array_pop($stack);
                echo "結果: {$popped} をPopしました。 \n";
            }

        } elseif ($mode == '3') {
            if (empty($stack)) {
                echo "結果: empty (スタックは空です)\n";
            } else {
                $top = end($stack);
                echo "結果: 現在の一番上(Peek)は{$top} です。\n";
            }   

        } elseif ($mode == '4') {
            if (empty($stack)) {
                echo "empty\n";
            } else {
                echo "not empty \n";
            }
    } else {
        echo "プログラムを終了します。 \n";
        break;
    }
}