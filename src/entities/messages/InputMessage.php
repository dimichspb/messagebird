<?php
namespace dimichspb\messagebird\entities\messages;

/**
 * Class InputMessage
 * @package dimichspb\messagebird\entities\messages
 */
class InputMessage
{
    /**
     * @var Number
     */
    protected $number;
    /**
     * @var Text
     */
    protected $text;

    /**
     * InputMessage constructor.
     * @param Number $number
     * @param Text $text
     */
    public function __construct(Number $number, Text $text)
    {
        $this->number = $number;
        $this->text = $text;
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