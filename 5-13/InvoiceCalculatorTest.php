<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/InvoiceCalculator.php';

class InvoiceCalculatorTest extends TestCase {
    private $calculator;

    protected function setUp(): void {
        $this->calculator = new InvoiceCalculator();
    }

    public function testAddItemAndCalculateTotal() {
        $this->calculator->addItem('Apple', 100);
        $this->calculator->addItem('Banana', 200);
        $this->assertEquals(300, $this->calculator->calculateTotal());
    }

    public function testApplyDiscountWithValidCode() {
        $this->calculator->addItem('Item A', 1000);
        $this->assertEquals(900, $this->calculator->applyDiscount('DISCOUNT10'));
    }

    public function testApplyDiscountWithInvalidCode() {
        $this->expectException(Exception::class);
        $this->calculator->applyDiscount('INVALID_CODE');
    }
}
