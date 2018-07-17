<?php
/**
 * Created by PhpStorm.
 * User: dtaranti
 * Date: 17.07.2018
 * Time: 12:31
 */

namespace dimichspb\messagebird\tests\entities\messages;

use dimichspb\messagebird\entities\messages\Number;
use dimichspb\messagebird\entities\messages\OutputMessage;
use dimichspb\messagebird\entities\messages\Text;
use dimichspb\messagebird\entities\messages\udh\Count;
use dimichspb\messagebird\entities\messages\udh\Current;
use dimichspb\messagebird\entities\messages\udh\Reference;
use dimichspb\messagebird\entities\messages\udh\Udh;

class OutputMessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OutputMessage
     */
    protected $outputMessage;

    /**
     * @var Number
     */
    protected $number;

    /**
     * @var Text
     */
    protected $text;

    /**
     * @var Count
     */
    protected $count;

    /**
     * @var Current
     */
    protected $current;

    public function setUp()
    {
        $this->outputMessage = new OutputMessage(
            $this->number = new Number('01234567890'),
            $this->text = new Text('This is out top important test message')
        );
    }

    public function testSetReference()
    {
        $this->outputMessage->setReference(255);

        $reflection = new \ReflectionClass($this->outputMessage);
        $property = $reflection->getProperty('udh');
        $property->setAccessible(true);

        $udh = $property->getValue($this->outputMessage);

        $this->assertSame($udh->getReference()->getValue(), 'ff');
    }

    public function test__construct()
    {
        $reflection = new \ReflectionClass($this->outputMessage);
        $number = $reflection->getProperty('number');
        $number->setAccessible(true);
        $text = $reflection->getProperty('text');
        $text->setAccessible(true);
        $udh = $reflection->getProperty('udh');
        $udh->setAccessible(true);

        $this->assertSame($number->getValue($this->outputMessage), $this->number);
        $this->assertSame($text->getValue($this->outputMessage), $this->text);
        $this->assertInstanceOf(Udh::class, $udh->getValue($this->outputMessage));
    }

    public function testSetCurrent()
    {
        $this->outputMessage->setCurrent(2);

        $reflection = new \ReflectionClass($this->outputMessage);
        $property = $reflection->getProperty('udh');
        $property->setAccessible(true);

        $udh = $property->getValue($this->outputMessage);

        $this->assertSame($udh->getCurrent()->getValue(), '02');
    }

    public function testGetText()
    {
        $reflection = new \ReflectionClass($this->outputMessage);
        $property = $reflection->getProperty('udh');
        $property->setAccessible(true);

        $udh = $property->getValue($this->outputMessage);

        $udhString = $udh->toString();

        $this->assertSame(($udhString . ' ' . $this->text->getValue()), $this->outputMessage->getText()->getValue());
    }

    public function testGetNumber()
    {
        $this->assertSame($this->outputMessage->getNumber(), $this->number);
    }

    public function testSetCount()
    {
        $this->outputMessage->setCount(2);

        $reflection = new \ReflectionClass($this->outputMessage);
        $property = $reflection->getProperty('udh');
        $property->setAccessible(true);

        $udh = $property->getValue($this->outputMessage);

        $this->assertSame($udh->getCount()->getValue(), '02');
    }
}
