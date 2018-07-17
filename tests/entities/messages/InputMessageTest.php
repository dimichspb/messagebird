<?php
/**
 * Created by PhpStorm.
 * User: dtaranti
 * Date: 17.07.2018
 * Time: 12:23
 */

namespace dimichspb\messagebird\tests\entities\messages;

use dimichspb\messagebird\entities\messages\Number;
use dimichspb\messagebird\entities\messages\InputMessage;
use dimichspb\messagebird\entities\messages\Text;

class InputMessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var InputMessage
     */
    protected $inputMessage;

    /**
     * @var Number
     */
    protected $number;

    /**
     * @var Text
     */
    protected $text;

    public function setUp()
    {
        $this->inputMessage = new InputMessage(
            $this->number = new Number('01234567890'),
            $this->text = new Text('This is out top important test message')
        );
    }

    public function testGetNumber()
    {
        $this->assertSame($this->inputMessage->getNumber(), $this->number);
    }

    public function testGetText()
    {
        $this->assertSame($this->inputMessage->getText(), $this->text);
    }

    public function test__construct()
    {
        $inputMessage = new InputMessage(
            $number = new Number('01234567890'),
            $text = new Text('This is out top important test message')
        );

        $reflection = new \ReflectionClass($inputMessage);
        $number = $reflection->getProperty('number');
        $number->setAccessible(true);
        $text = $reflection->getProperty('text');
        $text->setAccessible(true);

        $this->assertSame($number->getValue($this->inputMessage), $this->number);
        $this->assertSame($text->getValue($this->inputMessage), $this->text);
    }
}
