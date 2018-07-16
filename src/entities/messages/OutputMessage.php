<?php
namespace dimichspb\messagebird\entities\messages;

class OutputMessage
{
    /**
     * @var Header
     */
    protected $header;

    /**
     * @var Number
     */
    protected $number;

    /**
     * @var Text
     */
    protected $text;

    public function __construct(Header $header, Number $number, Text $text)
    {
        $this->header = $header;
        $this->number = $number;
        $this->text = $text;
    }

    /**
     * @return Header
     */
    public function getHeader()
    {
        return $this->header;
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
        return $this->text;
    }
}