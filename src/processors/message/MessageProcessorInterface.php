<?php
namespace dimichspb\messagebird\processors\message;

use dimichspb\messagebird\entities\messages\InputMessage;

/**
 * Interface MessageProcessorInterface
 * @package dimichspb\messagebird\processors\message
 */
interface MessageProcessorInterface
{
    /**
     * @param InputMessage $inputMessage
     * @return mixed
     */
    public function process(InputMessage $inputMessage);
}