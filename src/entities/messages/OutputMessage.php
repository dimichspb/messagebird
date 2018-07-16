<?php
namespace dimichspb\messagebird\entities\messages;

use dimichspb\messagebird\entities\messages\udh\Count;
use dimichspb\messagebird\entities\messages\udh\Current;
use dimichspb\messagebird\entities\messages\udh\Identifier;
use dimichspb\messagebird\entities\messages\udh\Length;
use dimichspb\messagebird\entities\messages\udh\Reference;
use dimichspb\messagebird\entities\messages\udh\ShortLength;
use dimichspb\messagebird\entities\messages\udh\Udh;
use dimichspb\messagebird\helpers\AssertHelper;

class OutputMessage
{
    /**
     * @var Number
     */
    protected $number;

    /**
     * @var Text
     */
    protected $text;

    protected $reference = 0;
    protected $count = 1;
    protected $current = 1;

    protected $udh;

    public function __construct(Number $number, Text $text)
    {
        $this->number = $number;
        $this->text = $text;

        $this->udh = new Udh(
            Length::createDefault(),
            Identifier::createDefault(),
            ShortLength::createDefault(),
            Reference::createDefault(),
            Count::createDefault(),
            Current::createDefault()
        );
    }

    /**
     * @return Number
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return Text
     */
    public function getText()
    {
        return new Text($this->udh->toString() . ' ' . $this->text->getValue());
    }

    public function setCount($count)
    {
        AssertHelper::isInteger($count);
        AssertHelper::isTrue($count <= 255);
        $this->count = $count;
        $this->udh->setCount(new Count(dechex($count)));
    }

    public function setCurrent($current)
    {
        AssertHelper::isInteger($current);
        AssertHelper::isTrue($current <= 255);
        $this->current = $current;
        $this->udh->setCurrent(new Current(dechex($current)));
    }

    public function setReference($reference)
    {
        AssertHelper::isInteger($reference);
        AssertHelper::isTrue($reference <= 255);
        $this->reference = $reference;
        $this->udh->setReference(new Reference(dechex($reference)));
    }

}