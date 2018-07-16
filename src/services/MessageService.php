<?php
namespace dimichspb\messagebird\services;

use dimichspb\messagebird\adapters\ClientAdapterInterface;
use dimichspb\messagebird\entities\messages\InputMessage;
use dimichspb\messagebird\exceptions\ErrorProcessingMessageException;
use dimichspb\messagebird\parsers\ParserInterface;
use dimichspb\messagebird\processors\message\MessageProcessor;
use dimichspb\messagebird\processors\message\MessageProcessorInterface;
use dimichspb\messagebird\queue\Queue;
use dimichspb\messagebird\queue\workers\MessageWorker;
use dimichspb\messagebird\requests\RequestInterface;

class MessageService
{
    protected $clientAdapter;
    protected $queue;
    protected $processor;
    protected $parser;

    public function __construct(ClientAdapterInterface $clientAdapter, Queue $queue, MessageProcessorInterface $processor, ParserInterface $parser)
    {
        $this->clientAdapter = $clientAdapter;
        $this->queue = $queue;
        $this->processor = $processor;
        $this->parser = $parser;
    }

    public function create(RequestInterface $request)
    {
        $inputMessage = $this->parser->parse($request->getBody());
        $outputMessages = $this->processor->process($inputMessage);

        $initialCount = count($outputMessages);
        $successCount = 0;

        foreach ($outputMessages as $outputMessage) {
            $worker = new MessageWorker($this->clientAdapter);
            $worker->setMessage($outputMessage);
            if ($this->queue->add($worker)) {
                $successCount++;
            }
        }

        if ($initialCount !== $successCount) {
            throw new ErrorProcessingMessageException('Error processing messages, initial count: ' .
                $initialCount . ', processed: ' . $successCount);
        }

        return $successCount;
    }
}