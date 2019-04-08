<?php
namespace TDD\Test;
require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR .'autoload.php';

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

class ReceiptTest extends TestCase {
    public function testTotal() {
        $Receipt = new Receipt();
        //create a new instance of the Receipt class
        $this->assertEquals(
        //write first assertion to pass in a simple array of some ints
            15,
        //we'll set the expected value of 15
            $Receipt->total([0,2,5,8]),
        //we'll pass in our variable Receipt->totaland pass in an array with the values zero, two, five, and eight on line 16

            'When summing the total should equal 15'
        );
    }
}
