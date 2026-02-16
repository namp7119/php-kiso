<?php

class Meal {
    private $name;
    private $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName() { return $this->name; }
    public function getPrice() { return $this->price; }
}

class order {
    private $name;
    private $order;
    private $meals = [];

    public function __construct($name, $order) {
        $this->name = $name;
        $this->order = $order;
    }

    public function addMeal($meal) {
        $this->meals[] = $meal;
    }

    public function getTotalPrice() {
        $total = 0;
        foreach($this->meals as $meal) {
            $total += $meal->getPrice();
        }
        return $total;
    }

    public function placeOrder() {
        echo "注文確定:[ID: " . $this->order . " ] " . $this->name . " 様\n";
        foreach ($this->meals as $meal) {
            echo "- " . $meal->getName() . ": ¥" . $meal->getPrice() . "\n";
        }
        echo"合計金額: ¥" . $this->getTotalPrice() . "\n";
    }

}

$meal1 = new Meal("ピザ" , 1000);
$meal2 = new Meal("パスタ" , 800);

$order =new Order("澤口" , "15");
$order->addMeal($meal1);
$order->addMeal($meal2);

$order->placeOrder();