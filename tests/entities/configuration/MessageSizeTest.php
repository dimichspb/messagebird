<?php
/**
 * Created by PhpStorm.
 * User: dtaranti
 * Date: 17.07.2018
 * Time: 12:15
 */

namespace dimichspb\messagebird\tests\entities\configuration;

use dimichspb\messagebird\entities\configuration\MessageSize;
use dimichspb\messagebird\exceptions\AssertionException;

class MessageSizeTest extends \PHPUnit_Framework_TestCase
{

    public function test__constructSuccess()
    {
        $messagesSize = new MessageSize(10);

        $this->assertSame($messagesSize->getValue(), 10);
    }

    public function test__constructExceptionThrown()
    {
        $this->setExpectedException(AssertionException::class);

        $messagesSize = new MessageSize('aa');
    }
}
