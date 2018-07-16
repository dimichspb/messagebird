<?php
namespace dimichspb\messagebird\queue\workers;

use dimichspb\messagebird\adapters\ClientAdapterInterface;
use dimichspb\messagebird\adapters\MessageBirdClientAdapter;
use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\entities\configuration\AccessKey;
use dimichspb\messagebird\entities\messages\OutputMessage;
use dimichspb\messagebird\services\ClientService;

class MessageWorker implements WorkerInterface
{
    protected $clientService;
    protected $message;

    public function __construct(ClientAdapterInterface $clientAdapter, OutputMessage $message = null)
    {
        $this->clientService = new ClientService($clientAdapter);
        $this->message = $message;
    }

    public function setMessage(OutputMessage $message)
    {
        $this->message = $message;
    }

    public function run()
    {
        return $this->clientService->send($this->message);
    }

}