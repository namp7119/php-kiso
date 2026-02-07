<?php

$capitals = [
    "日本" => "東京",
    "アメリカ" => "ワシントン",
    "イギリス" => "ロンドン",
    "フランス" => "パリ",
];

foreach ($capitals as $country => $city) {
    echo $country . "の首都は" . $city . "です。\n";
}
