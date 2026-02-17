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
        if ($amount > 0) $this->balance += $amount;
        }  

    public function withdraw($amount) {
        if ($amount > $this->balance) {
            echo "残高不足です。\n";
        } elseif($amount > 0) {
            $this->balance -= $amount;
        }
    }


    public function getBalance() {return $this->balance;}
    public function getAccountNumber() {return $this->accountNumber;}
    public function getType() {return $this->type;}
}



class Customer  {
    private $name;
    private $account;

    public function __construct($name, $account) {
        $this->name = $name;
        $this->account = $account;
    }

    public function getName() {return $this->name;}
    public function getAccount() {return $this->account;}

    public function getAccountDetails() {
        return $this->account;
    }    
}


class Bank {
    private $customers =[];

   public function addCustomer(Customer $customer) {
        $this->customers[] = $customer;
   }

   public function getCustomerInfo($name) {
        foreach ($this->customers as $customer) {
            if ($customer->getName() === $name) {
                return $customer;
            }
        }    

        return null;
        
   } 
}   


$account1 = new Account("123456" , "普通預金");
$customer1 =new Customer("澤口" , $account1);
$bank = new Bank();

$bank->addCustomer($customer1);

$account1->deposit(10000);
$account1->withdraw(3000);

$info = $bank->getCustomerInfo("澤口");
if ($info) {
    $a = $info->getAccount();
    echo "銀行口座情報" . PHP_EOL;
    echo "顧客: " . $info->getName() . PHP_EOL;
    echo "口座: " . $a->getAccountNumber() . " [" . $a->getType() . "]" . PHP_EOL;
    echo "残高: " . number_format($a->getBalance()) . "円" . PHP_EOL;
}