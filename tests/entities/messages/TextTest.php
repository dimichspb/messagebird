<?php
/**
 * Created by PhpStorm.
 * User: dtaranti
 * Date: 17.07.2018
 * Time: 12:44
 */

namespace dimichspb\messagebird\tests\entities\messages;

use dimichspb\messagebird\entities\messages\Text;
use dimichspb\messagebird\exceptions\AssertionException;

class TextTest extends \PHPUnit_Framework_TestCase
{

    public function test__constructSuccess()
    {
        $text = new Text('This is our top important test text');

        $this->assertSame($text->getValue(), 'This is our top important test text');
    }

    public function test__constructExceptionThrown()
    {
        $this->setExpectedException(AssertionException::class);

        $text = new Text(123);
    }
}
