<?php

date_default_timezone_set('Asia/Tokyo');

//現在日時
$now = new DateTime();
echo $now->format('Y-m-d H:i:s') . "\n";

//現在日時から３日後
$threeDaysAfter = new DateTime('+3 days');
echo $threeDaysAfter->format('Y-m-d H:i:s') . "\n";

//現在日時から12時間前
$twelveHoursAgo = new DateTime('-12 hours');
echo $twelveHoursAgo->format('Y-m-d H:i:s') . "\n";

//2020年元旦から現在までの経過日数
$gantan = new DateTime('2020-01-01');
$interval = $gantan->diff($now);
echo $interval->days . "日\n";