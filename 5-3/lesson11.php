<?php

$users = [
    [
        "name" => "田中",
        "age" => "25",
        "gender" => "男"
    ],
    [
        "name" => "鈴木",
        "age" => "20",
        "gender" => "男"
    ],
    [  
        "name" => "佐藤",
        "age" => "23",
        "gender" => "女"
    ]
];

foreach ($users as $user) {
    echo $user["name"] .  $user["age"]  . $user["gender"] . "\n";
}

echo $users[1]["age"];
