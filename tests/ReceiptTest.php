<?php
namespace TDD\Test;
require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR .'autoload.php';

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

class ReceiptTest extends TestCase {
    public function setUp() {
        //we'll add public function setUpand
        $this->Receipt = new Receipt();
        //we'll add this arrow Receipt is equal to new Receiptinside of the setUp method
        //create a new instance of the Receipt class
    }

    public function tearDown() {
    //we'll add public function tearDown
        unset($this->Receipt);
    // we'll add unset this arrow Receipt
    }
    public function testTotal() {
        $input = [0,2,5,8];
        $output = $this->Receipt->total($input);
        //we'll add variable output is equal to this arrow Receipt arrow total, pass in our variable input, add our semicolon and we'll take output and set it on line 21

        $this->assertEquals(
        //write first assertion to pass in a simple array of some ints
            15,
            //we will erase the Receipt arrow total
            //we'll set the expected value of 15
            $output,
            'When summing the total should equal 15'
        );
    }

    public function testTax() {
        $inputAmount = 10.00;
        //We can add an input amount variable of equal to 10 dollars, or 10.00
        $taxInput = 0.10;
        //we'll add taxInput and it'll be equal to 0.10 After this, we can call a tax method on our receipt object
        $output = $this->Receipt->tax($inputAmount, $taxInput);
        $this->assertEquals(
        //we can assert that the tax amount should be equal to 1.00 or 11.00 if sum together
            1.00,
            $output,
            'The tax calculation should equal 1.00'
        );
    }
}