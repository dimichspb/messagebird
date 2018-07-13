<?php
namespace dimichspb\messagebird\processors\message;

use dimichspb\messagebird\entities\messages\InputMessage;
use dimichspb\messagebird\entities\messages\OutputMessage;

class MessageProcessor
{
    /**
     * @param InputMessage $inputMessage
     * @return OutputMessage[]
     */
    public function process(InputMessage $inputMessage)
    {
        $outputMessages = [];

        return $outputMessages;
    }
}