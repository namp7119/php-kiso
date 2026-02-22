<?php
use PHPUnit\Framework\TestCase;
require_once dirname(__DIR__) . '/InvoiceCalculator.php';
class InvoiceCalculatorTest extends TestCase {


    private $calculator;

    protected function setUp(): void {
        $this->calculator = new InvoiceCalculater();
    }

    public function testAddItemCalculateTotal() {
        $this->calculator->addItem('Apple', 100);
        $this->calculator->addItem('Banana', 200);
        $this->calculator->addItem('orange', 150);

        $this->assertEquals(450, $this->calculator->calculateTotal());
    }

    public function testApplyDiscountWithVaildCode() {
        $this->calculator->addItem('Item A', 1000);

        $discountedTotal = $this->calculator->applyDiscount('DISCOUNT10');

        $this->assertEquals(900, $discountedTotal);
    }

    public function testApplyDiscountWithInvaildCode() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Invalid discount code");

        $this->calculator->addItem('Item A', 1000);
        $this->calculator->applyDiscount('INVALID_CODE');
    }
}