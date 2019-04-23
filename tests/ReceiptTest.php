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
    /**
     * @dataProvider provideTotal
     */
    //// we'll add a dot block, and add the annotation @dataProvider provideTotal
    public function testTotal($items, $expected) {
        // Coupon = null is the dummy object
        $coupon = null;
        // Remove the input bar
        //we  add an instance named coupon that is = null
        $output = $this->Receipt->total($items, $coupon);
        //here we add coupon as well
        // /we'll add variable output is equal to this arrow Receipt arrow total, pass in our variable input, add our semicolon and we'll take output and set it on line 30
        $this->assertEquals(
        //write first assertion to pass in a simple array of some ints
        //  //we will erase the Receipt arrow total
        //we'll set the expected value of 15
            $expected,
            $output,
            "When summing the total should equal {$expected}"
        //  replace our value 15 with the expected result.
        // update the message to use double quotes
        );
    }

    public function provideTotal() {
        // we'll add public function provideTotal
        return [
            'ints totaling 16' => [[1,2,5,8], 16],
            // We add 'ints totalling 16' and see how we can filter tests by a particular key
            [[-1,2,5,8], 14],
        // we'll set the positive value one to a negative one, which will reduce our expected value to be 14
            [[1,2,8], 11],
        // We can modify the array on line 52 to remove the five, which will now set our expected value to be 11
        ];
    }

    public function testTotalAndCoupon() {
        $input = [0,2,5,8];
        $coupon = 0.20;
        //pass a coupon percentage value of 20% or 0.20.
        $output = $this->Receipt->total($input, $coupon);
        //The coupon is used and  take 20% off the total sum
        $this->assertEquals(
            12,
            //20%  of 15 is  3.
            $output,
            'When summing the total should equal 12'
        );
    }

    public function testTotalException() {
        //We'll then copy the test total and coupon method, which lives on lines 57 through 69, and we'll duplicate it, on lines 71 through 80.
        //We'll change the name of this method, to instead be Test Total Exception.
        // In this case, we'll modify the code to throw in the exception if the coupon value is greater than 1.00, or, in otherwords, greater than 100%.
        $input = [0,2,5,8];
        $coupon = 1.20;
        // we'll first modify the coupon to be 1.20
        $this->expectException('BadMethodCallException');
        // we'll add this, arrow, expect, exception.
        $this->Receipt->total($input, $coupon);
    }

    public function testPostTaxTotal() {
        //  Our test here will build a mock instance of the Receipt
        $items = [1,2,5,8];
        //  we'll add in items is equal to an array with the values 1, 2, 5, and 8.
        $tax = 0.20;
        //  We'll next add a tax amount which will be equal to 0.20
        $coupon = null;
        // we'll add a coupon value that will be equal to null.
        // Stub
        $Receipt = $this->getMockBuilder('TDD\Receipt')
            // we'll add $this->getMockBuilder and then pass in the string with the namespace name of the class that we want to build

            ->setMethods(['tax', 'total'])
            // we need to define the methods our stub will respond to, so we'll add - >setMethods().
            ->getMock();
        //  we can now return the instance of the mock with a call to getMock
        $Receipt->expects($this->once())
            // we add before our method call, we add arrow expects this once.
            ->method('total')
        // // we'll update our stub to respond to our two method calls for tax and total and then inform them to return the data that we want them to. To do so, we will add $Receipt->method and then pass in the string name of the method that we want to define what exactly our stub will perform. In this case, we'll pass in total.
            ->with($items, $coupon)
            //  we can add arrow, with, passing in items, and coupon
            ->will($this->returnValue(10.00));
        // // we then call a method will. This method will simply says what exactly will that stubbed method do. We'll add ->will(). In this case, this method will return a value equal to 10.00. So, we will do $this->returnValue(10.00).We now to repeat this for our tax method, which our tax method will return 1.00, so we'll add $Receipt->method('tax').
        $Receipt->expects($this->once())
        //  We'll add before the method call, arrow, expects, passing in the method, this, arrow, once.
            ->method('tax')
            ->with(10.00, $tax)
            ->will($this->returnValue(1.00));
        $result = $Receipt->postTaxTotal([1,2,5,8], 0.20, null);
        // add $result is equal to our $Receipt instance - >postTaxTotal with an array of one, two, five, and eight.
        $this->assertEquals(11.00, $result);
        //We will now add the assert to assert that the result is equal to 11. We'll add $this->assertEquals(11.00) and then $result.
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