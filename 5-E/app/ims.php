<?php

class Product {
    public $name;
    public $price;
    public $quantity;

    public function __construct($name, $price, $quantity) {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }
}

class Inventory {
    private $products = [];

    public function addProduct(Product $product) {
        $this->products[$product->name] = $product;
    }

    public function updateQuantity($name, $quantity) {
        if (!isset($this->products[$name])) {
            throw new Exception("商品が見つかりません: " . $name);
        }
        $this->products[$name]->quantity = $quantity;
    }

    public function calculateTotalValue() {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->price * $product->quantity;
        }
        return $total;
    }

    public function information() {
        foreach ($this->products as $product) {
            echo "商品: {$product->name}, 金額: {$product->price}円, 数量: {$product->quantity}\n";
        }
        echo "在庫の総価値: " . $this->calculateTotalValue() . "円\n";
    }
}

// 在庫の作成と商品の追加
$inventory = new Inventory();
$inventory->addProduct(new Product("Apple", 10, 30));
$inventory->addProduct(new Product("Banana", 5, 50));
$inventory->addProduct(new Product("Orange", 8, 25));

// 商品の数量を更新
$inventory->updateQuantity("Apple", 25);
$inventory->updateQuantity("Banana", 55);

// 在庫情報を出力
$inventory->information();