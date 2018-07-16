<?php
namespace dimichspb\messagebird\services;

use dimichspb\messagebird\adapters\ClientAdapterInterface;

use dimichspb\messagebird\exceptions\ErrorProcessingMessageException;
use dimichspb\messagebird\parsers\ParserInterface;

use dimichspb\messagebird\processors\message\MessageProcessorInterface;
use dimichspb\messagebird\queue\Queue;
use dimichspb\messagebird\queue\workers\MessageWorker;
use dimichspb\messagebird\requests\RequestInterface;

/**
 * Class MessageService
 * @package dimichspb\messagebird\services
 */
class MessageService
{
    /**
     * @var ClientAdapterInterface
     */
    protected $clientAdapter;
    /**
     * @var Queue
     */
    protected $queue;
    /**
     * @var MessageProcessorInterface
     */
    protected $processor;
    /**
     * @var ParserInterface
     */
    protected $parser;

    /**
     * MessageService constructor.
     * @param ClientAdapterInterface $clientAdapter
     * @param Queue $queue
     * @param MessageProcessorInterface $processor
     * @param ParserInterface $parser
     */
    public function __construct(ClientAdapterInterface $clientAdapter, Queue $queue, MessageProcessorInterface $processor, ParserInterface $parser)
    {
        $this->clientAdapter = $clientAdapter;
        $this->queue = $queue;
        $this->processor = $processor;
        $this->parser = $parser;
    }

    /**
     * @param RequestInterface $request
     * @return int
     * @throws ErrorProcessingMessageException
     */
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