<?php
namespace dimichspb\messagebird\services;

use dimichspb\messagebird\adapters\ClientAdapterInterface;
use dimichspb\messagebird\entities\messages\InputMessage;
use dimichspb\messagebird\processors\message\MessageProcessor;
use dimichspb\messagebird\queue\Queue;
use dimichspb\messagebird\queue\workers\MessageWorker;

class MessageService
{
    protected $clientAdapter;
    protected $queue;
    protected $processor;

    public function __construct(ClientAdapterInterface $clientAdapter, Queue $queue, MessageProcessor $processor)
    {
        $this->clientAdapter = $clientAdapter;
        $this->queue = $queue;
        $this->processor = $processor;
    }

    public function create(InputMessage $inputMessage, ClientAdapterInterface $clientAdapter)
    {
        $outputMessages = $this->processor->process($inputMessage);

        foreach ($outputMessages as $outputMessage) {
            $worker = new MessageWorker($this->clientAdapter);
            $worker->setMessage($outputMessage);
            $this->queue->add($worker);
        }

        return true;
    }
}