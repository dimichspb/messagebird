<?php
namespace dimichspb\messagebird\processors\message;

use dimichspb\messagebird\entities\messages\InputMessage;

interface MessageProcessorInterface
{
    public function process(InputMessage $inputMessage);
}