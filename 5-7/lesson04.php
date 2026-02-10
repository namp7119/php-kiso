<?php

$queue = [];

while (true) {
    echo "\n⬜︎モード選択 (1:Enqueue, 2:Dequeue, 3:Front, 4:IsEmpty, その他:終了): ";

    $mode = trim(fgets(STDIN));

    if ($mode === '1') {
        echo "Enqueueするデータを入力してください: ";
        $data = trim(fgets(STDIN));
        array_push($queue, $data);
        echo " 「{$data}」をエンキューしました。 \n";

    } elseif ($mode === '2') {
        if (empty($queue)) {
            echo "error: キューが空です。 \n";
        } else {
            $removed = array_shift($queue);
            echo " 「{$removed}」をデキューしました。\n";
        }

    } elseif ($mode === '3') {
        if (empty($queue)) {
            echo "empty\n";
        } else {
            echo "Front: " . $queue[0] . "\n";
        }
 
    } elseif ($mode === '4') {
        if (empty($queue)) {
            echo "empty\n";
        } else {
            echo "not empty\n";
        }
    } else {
        echo "プログラムを終了します。 \n";
        break;
    }
}