<?php

function findGCD($a, $b) {

    while ($b !== 0) {
        $diff = abs($a - $b);

        echo $diff . "\n";

        if ($a > $b) {
            $a = $a % $b;
        } else {
            $b = $b % $a;
        } 

        if ($a === 0) return $b;
        if ($b === 0) return $a;
    }
}

$num1 = 1116;
$num2 = 708;

$gcd = findGCD($num1, $num2);

echo "{$num1}と{$num2}の最大公約数は{$gcd}\n";


