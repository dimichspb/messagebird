<?php
namespace dimichspb\messagebird\processors\message;

use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\entities\configuration\MessageSize;
use dimichspb\messagebird\entities\messages\InputMessage;
use dimichspb\messagebird\entities\messages\Number;
use dimichspb\messagebird\entities\messages\OutputMessage;
use dimichspb\messagebird\entities\messages\Text;


/**
 * Class MessageProcessor
 * @package dimichspb\messagebird\processors\message
 */
class MessageProcessor implements MessageProcessorInterface
{
    /**
     * @var MessageSize
     */
    protected $messageSize;

    /**
     * MessageProcessor constructor.
     * @param Configurator $configurator
     */
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