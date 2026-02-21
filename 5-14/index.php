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

$resultMessage = "";
$displayCards = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $params = [];
    $isComplete = true;
    for ($i = 1; $i <= 5; $i++) {
        $suit = $_POST["suit$i"] ?? '';
        $num = $_POST["number$i"] ??'';
        if ($suit === '' || $num === '') $isComplete = false;
        $params[] = $suit;
        $params[] = $num;    
    }

    if ($isComplete) {
        $poker = new Poker_Hand(...$params);
        $poker->setPokerHandJudge();
        $resultMessage = $poker->getPokerHandJudge();

        foreach ($poker->getCard() as $c) {
            $displayCards[] = new Card($c['suit'], $c['number']);
        }
    } else {
        $resultMessage = "5枚すべてのカードを選択してください";
    }    
}
?>


<!DOCTYPE html>
<html data-wf-page="65a6358f98ae25d9e60af7b3" data-wf-site="65a6257c9b4dab4f4c5b2ebc">
<head>
  <meta charset="utf-8">
  <title>Pocker Program</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/stylesheet.css" rel="stylesheet" type="text/css">
  <link href="css/poker-game-sample.css" rel="stylesheet" type="text/css">
  <link href="images/spade/1.png" rel="shortcut icon" type="image/x-icon">
</head>
<body>
  <div class="w-form">
    <form id="email-form" action="index.php" name="email-form" data-name="Email Form" method="post" class="form-2" data-wf-page-id="65a6358f98ae25d9e60af7b3" data-wf-element-id="86774d01-babd-216e-a0af-c3f43d9ae051">
      <div class="w-layout-blockcontainer container-2 w-container">

        <?php for ($i = 1; $i <=5; $i++): ?>
        <div class="w-layout-blockcontainer container-<?php echo ($i+2); ?> w-container">
          <label class="field-label">CARD <?php echo $i; ?></label>
          <div class="w-layout-blockcontainer container w-container">
            <select name="suit<?php echo $i; ?>" class="suit-<?php echo $i; ?> w-select">
              <option value=""></option>
              <option value="spade" <?php if(isset($_POST["suit$i"]) && $_POST["suit$i"] == 'spade') echo 'selected'; ?>>spade</option>
              <option value="heart" <?php if(isset($_POST["suit$i"]) && $_POST["suit$i"] == 'heart') echo 'selected'; ?>>heart</option>
              <option value="diamond" <?php if(isset($_POST["suit$i"]) && $_POST["suit$i"] == 'diamond') echo 'selected'; ?>>diamond</option>
              <option value="club" <?php if(isset($_POST["suit$i"]) && $_POST["suit$i"] == 'club') echo 'selected'; ?>>club</option>
            </select>
            <select name="number<?php echo $i; ?>" class="number<?php echo $i; ?> w-select">
              <option value=""></option>
              <?php for ($n = 1; $n <= 13; $n++): ?>
                <option value="<?php echo $n; ?>" <?php if(isset($_POST["number$i"]) && $_POST["number$i"] == $n) echo 'selected'; ?>><?php echo $n; ?></option>
              <?php endfor; ?>  
            </select>
          </div>
        </div>
        <?php endfor; ?>

     </div>
     <button type="submit" class="button w-button">SEND</button>
   </form>
 </div>

  <section>
    <h1 class="heading-2">hand of cards : </h1>
    <div class="w-layout-grid grid">
      <?php if (!empty($displayCards)): ?>
          <?php foreach ($displayCards as $card): ?>
              <img src="<?php echo htmlspecialchars($card->getImagePath()); ?>" loading="lazy" alt="card">
          <?php endforeach; ?>
      <?php else: ?>
          <p style="color:gray;"></p>
      <?php endif; ?>
    </div>
  </section>

  <h1 class="heading-3">
    
     <strong>A poker hand→</strong> <?php echo htmlspecialchars($resultMessage); ?>
  </h1>
</body>
</html>