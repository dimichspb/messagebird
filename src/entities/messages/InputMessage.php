<?php
namespace dimichspb\messagebird\entities\messages;

class InputMessage
{
    protected $number;
    protected $text;

    public function __construct(Number $number, Text $text)
    {
        $this->number = $number;
        $this->text = $text;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getText()
    {
        return $this->text;
    }
}