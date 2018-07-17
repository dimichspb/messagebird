<?php
/**
 * Created by PhpStorm.
 * User: dtaranti
 * Date: 17.07.2018
 * Time: 12:29
 */

namespace dimichspb\messagebird\tests\entities\messages;

use dimichspb\messagebird\entities\messages\Number;
use dimichspb\messagebird\exceptions\AssertionException;

class NumberTest extends \PHPUnit_Framework_TestCase
{

    public function test__constructSuccess()
    {
        $number = new Number('01234567890');

        $this->assertSame($number->getValue(), '01234567890');
    }

    public function test__constructExceptionThrown()
    {
        $this->setExpectedException(AssertionException::class);

        $number = new Number(0);
    }
}
