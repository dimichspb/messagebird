<?php
namespace dimichspb\messagebird\processors\message;

use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\entities\configuration\MessageSize;
use dimichspb\messagebird\entities\messages\Header;
use dimichspb\messagebird\entities\messages\InputMessage;
use dimichspb\messagebird\entities\messages\Number;
use dimichspb\messagebird\entities\messages\OutputMessage;
use dimichspb\messagebird\entities\messages\Text;
use dimichspb\messagebird\entities\messages\udh\Identifier;
use dimichspb\messagebird\entities\messages\udh\Length;
use dimichspb\messagebird\entities\messages\udh\Reference;
use dimichspb\messagebird\entities\messages\udh\ShortLength;
use dimichspb\messagebird\entities\messages\udh\Udh;

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
        $reference = rand(0,255);

        $outputMessages = [];

        $inputMessages = explode($delimiter, wordwrap($inputMessage->getText(), $this->messageSize->getValue(), $delimiter));

        foreach ($inputMessages as $index => $message) {
            $outputMessage = new OutputMessage(
                new Number($inputMessage->getNumber()->getValue()),
                new Text($message)
            );

            $outputMessage->setCount(count($inputMessages));
            $outputMessage->setCurrent($index + 1);
            $outputMessage->setReference($reference);

            $outputMessages[] = $outputMessage;
        }

        return $outputMessages;
    }
}