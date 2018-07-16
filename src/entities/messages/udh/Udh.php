<?php
namespace dimichspb\messagebird\entities\messages\udh;

use dimichspb\messagebird\helpers\AssertHelper;

class Udh
{
    protected $length;
    protected $identifier;
    protected $shortLength;
    protected $reference;
    protected $count;
    protected $current;

    public function __construct(Length $length, Identifier $identifier, ShortLength $shortLength,
                                Reference $reference, Count $count, Current $current)
    {
        $this->length = $length;
        $this->identifier = $identifier;
        $this->shortLength = $shortLength;
        $this->reference = $reference;
        $this->count = $count;
        $this->current = $current;
    }

    /**
     * @return Length
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return Identifier
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @return ShortLength
     */
    public function getShortLength()
    {
        return $this->shortLength;
    }

    /**
     * @return Reference
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return Count
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return Current
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * @param Reference $reference
     */
    public function setReference(Reference $reference)
    {
        $this->reference = $reference;
    }

    /**
     * @param Count $count
     */
    public function setCount(Count $count)
    {
        $this->count = $count;
    }

    /**
     * @param Current $current
     */
    public function setCurrent(Current $current)
    {
        $this->current = $current;
    }

    public function toString()
    {
        return implode(' ', [
            chr(hexdec($this->length->getValue())),
            chr(hexdec($this->identifier->getValue())),
            chr(hexdec($this->shortLength->getValue())),
            chr(hexdec($this->reference->getValue())),
            chr(hexdec($this->count->getValue())),
            chr(hexdec($this->current->getValue())),
        ]);
    }
}