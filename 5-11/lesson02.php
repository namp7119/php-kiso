<?php

class Account {
    private $accountNumber;
    private $balance;
    private $type;

    public function __construct($accountNumber, $type) {
        $this->accountNumber = $accountNumber;
        $this->type = $type;
        $this->balance = 0;
    }

    public function deposit($amount) {
        if ($amount > 0) {
            $this->balance += $amount;
        }
    }    

    public function withdraw($amount) {
        if ($amount > $this->balance) {
            echo "残高不足です。\n";

        } elseif($amount > 0) {
            $this->balance -= $amount;
        }
    }

    public function getBalance() {
        return $this->balance;
    }

    public function getDetails() {
        return "口座番号: {$this->accountNumber} | 種類: {$this->type} | 残高:  ¥" . $this->balance;
    }
}



class Customer  {
    private $name;
    private $account;

    public function __construct($name, $account) {
        $this->name = $name;
        $this->account = $account;
    }

    public function getName() {
        return $this->name;
    }

    public function getAccountDetails() {
        return "顧客名: {$this->name} | " . $this->account->getDetails();
    }

    public function getAccount() {
        return $this->account;
    }
}    

class Bank {
    private $customers =[];

   public function addCustomer($customer) {
        $this->customers[] = $customer;
   }

   public function getCustomerInfo($name) {
        foreach ($this->customers as $customer) {
            if ($customer->getName() === $name) {
                return $customer-> getAccountDetails() . "\n";
            }
        }
        return "顧客名: {$name}が見つかりませんでした。\n";
        
   } 
}   


$account1 = new Account("123456" , "普通預金");

$customer1 =new Customer("澤口" , $account1);

$account1->deposit(10000);
$account1->withdraw(3000);

$bank = new Bank();
$bank->addCustomer($customer1);

echo $bank->getCustomerInfo("澤口");