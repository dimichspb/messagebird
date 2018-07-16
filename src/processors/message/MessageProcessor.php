<?php
namespace dimichspb\messagebird\processors\message;

use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\entities\configuration\MessageSize;
use dimichspb\messagebird\entities\messages\Header;
use dimichspb\messagebird\entities\messages\InputMessage;
use dimichspb\messagebird\entities\messages\Number;
use dimichspb\messagebird\entities\messages\OutputMessage;
use dimichspb\messagebird\entities\messages\Text;

class MessageProcessor implements MessageProcessorInterface
{
    protected $messageSize;

    public function __construct(Configurator $configurator)
    {
        $messageSize = new MessageSize($configurator->get('processor.message_size'));

        $this->messageSize = $messageSize;
    }

    /**
     * @param InputMessage $inputMessage
     * @return OutputMessage[]
     */
    public function process(InputMessage $inputMessage)
    {
        $delimiter = '|||';

        $outputMessages = [];

        $inputMessages = explode($delimiter, wordwrap($inputMessage->getText(), $this->messageSize->getValue(), $delimiter));

        foreach ($inputMessages as $message) {
            $outputMessages[] = new OutputMessage(
                new Header('header'),
                new Number($inputMessage->getNumber()->getValue()),
                new Text($message)
            );
        }

        return $outputMessages;
    }
}