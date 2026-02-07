<?php

date_default_timezone_set('Asia/Tokyo');

$week = ["日", "月", "火", "水", "木", "金", "土"];

$w =date("w");

echo date("Y年m月d日") . " (" . $week[$w] . "曜日）\n";
