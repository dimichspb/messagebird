<?php
namespace dimichspb\messagebird\queue\workers;

use dimichspb\messagebird\adapters\ClientAdapterInterface;


use dimichspb\messagebird\entities\messages\OutputMessage;
use dimichspb\messagebird\services\ClientService;

/**
 * Class MessageWorker
 * @package dimichspb\messagebird\queue\workers
 */
class MessageWorker implements WorkerInterface
{
    /**
     * @var ClientService
     */
    protected $clientService;
    /**
     * @var OutputMessage
     */
    protected $message;

    /**
     * MessageWorker constructor.
     * @param ClientAdapterInterface $clientAdapter
     * @param OutputMessage|null $message
     */
    public function __construct(ClientAdapterInterface $clientAdapter, OutputMessage $message = null)
    {
        $this->clientService = new ClientService($clientAdapter);
        $this->message = $message;
    }

    /**
     * @param OutputMessage $message
     */
    public function setMessage(OutputMessage $message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        return $this->clientService->send($this->message);
    }

}