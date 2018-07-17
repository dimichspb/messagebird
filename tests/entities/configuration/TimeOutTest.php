<?php
/**
 * Created by PhpStorm.
 * User: dtaranti
 * Date: 17.07.2018
 * Time: 12:20
 */

namespace dimichspb\messagebird\tests\entities\configuration;

use dimichspb\messagebird\entities\configuration\TimeOut;
use dimichspb\messagebird\exceptions\AssertionException;

class TimeOutTest extends \PHPUnit_Framework_TestCase
{

    public function test__constructSuccess()
    {
        $timeOut = new TimeOut(10);

        $this->assertSame($timeOut->getValue(), 10);
    }

    public function test__constructExceptionThrown()
    {
        $this->setExpectedException(AssertionException::class);

        $timeOut = new TimeOut('aa');
    }
}
