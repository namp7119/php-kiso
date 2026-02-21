<?php

//カード単体
class Card {
    public $suit;
    public $number;
    public $strength;

    public function __construct($suit, $number) {
        $this->suit = $suit;
        $this->number = (int)$number;
        //1だと弱くなるからAを一番強くするため14にする
        $this->strength = ($this->number === 1) ? 14 : $this->number;
    }

    public function getImagePath() {
        return "images/{$this->suit}/{$this->number}.png";
    }
}

//手札全体
class Poker_Hand {
    private $card = [];
    private $judge;

    public function __construct($s1, $n1, $s2, $n2, $s3, $n3, $s4, $n4, $s5, $n5) {
        $this->card = [
            ['suit' => $s1, 'number' => (int)$n1],
            ['suit' => $s2, 'number' => (int)$n2],
            ['suit' => $s3, 'number' => (int)$n3],
            ['suit' => $s4, 'number' => (int)$n4],
            ['suit' => $s5, 'number' => (int)$n5],
        ];
    }

    public function setPokerHandJudge() {
        //不正チェック（重複など）
        if (!$this->fraudJudge()) {
            $this->judge = "Illegal hand";
            return;
        }

        $hand = [];
        foreach ($this->card as $c) {
            $hand[] = new Card($c['suit'], $c['number']);
        }

        $hand = $this->cardSort($hand);
    
        $s = array_column($hand, 'strength');
        $suits = array_column($hand, 'suit');
        $counts = array_count_values($s); //ワンペア、スリーカード、フルハウスの枚数系
        arsort($counts);//枚数多い順に並べ替え

        $isFlush = count(array_unique($suits)) === 1;
        $isStraight = $this->checkStraight($s);

        if ($isFlush && $isStraight && min($s) === 10) {
            $this->judge = "Royal Straight Flush";
        } elseif ($isFlush && $isStraight) {    
            $this->judge =  "Straight Flush";
        } else {
        $maxCount = max($counts);
        if ($maxCount === 4) $this->judge = "Four Card";
        elseif ($maxCount === 3 && count($counts) === 2) $this->judge = "Full House";
        elseif ($isFlush) $this->judge = "Flush";
        elseif ($isStraight) $this->judge = "Straight";
        elseif ($maxCount === 3) $this->judge = "Three Card";
        elseif ($maxCount === 2 && count($counts) === 3) $this->judge = "Two Pair";
        elseif ($maxCount === 2) $this->judge = "One Pair";
        else $this->judge = "None";
        }
    }


    public function getPokerHandJudge() {
        return $this->judge;
    }

    public function getCard() {
        return $this->card;
    }

    private function cardSort($hand) {
        usort($hand, fn($a, $b) => $a->strength <=> $b->strength);
        return $hand;
    }

    private function fraudJudge() {
        $check = [];
        foreach ($this->card as $c) {
            $key = $c['suit'] . $c['number'];
            if (isset($check[$key])) return false;
            $check[$key] = true;
        }
        return true;
    }

    private function checkStraight($s) {
        //通常の5連続
        if (count(array_unique($s)) === 5 && (max($s) - min($s) === 4)) 
            return true;
        //A,2,3,4,5の場合
        $aceLow = [2, 3, 4, 5, 14];
        if ($s === $aceLow) {
            return true;
        }
        return false;
    }
}

if (PHP_SAPI === 'cli') {
    //ターミナル
    echo "\n";
    echo "カードを5枚入力してください\n";

    $params = [];
    for ($i = 1; $i <= 5; $i++) {
        echo "{$i}枚目 スート(h,s,d,c): ";
        $suit = trim(fgets(STDIN));
        echo "{$i}枚目 数字(1-13): ";
        $num = trim(fgets(STDIN));

        $params[] = $suit;
        $params[] = $num;
    }

    $poker = new Poker_Hand(...$params);
    $poker->setPokerHandJudge();

    echo $poker->getPokerHandJudge() . "\n";

} else {
    //ブラウザ
    $resultMessage = "";
    $displayCards = [];

    if (($_SERVER["REQUEST_METHOD"] ?? '') === "POST") {
        $params = [];
        $isComplete = true;
        for ($i = 1; $i <= 5; $i++) {
            $suit = $_POST["suit$i"] ?? '';
            $num = $_POST["number$i"] ?? '';
            if ($suit === '' || $num === '') $isComplete = false;
            $params[] = $suit;
            $params[] = $num;
        }

        if ($isComplete) {
            $poker =new Poker_Hand(...$params);
            $poker->setPokerHandJudge();
            $resultMessage = $poker->getPokerHandJudge();

            foreach ($poker->getCard() as $c) {
                $displayCards[] = new Card($c['suit'], $c['number']);
            }
        } else {
            $resultMessage = "5枚全てのカードを選択しください";
        }
    }

}
?>