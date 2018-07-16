<?php
namespace dimichspb\messagebird\services;

use dimichspb\messagebird\adapters\ClientAdapterInterface;
use dimichspb\messagebird\entities\messages\OutputMessage;

class ClientService
{
    protected $clientAdapter;

    public function __construct(ClientAdapterInterface $clientAdapter)
    {
        $this->clientAdapter = $clientAdapter;
    }

    public function balance()
    {
        return $this->clientAdapter->getBalance();
    }

    public function send(OutputMessage $message)
    {
        return $this->clientAdapter->sendMessage($message);
    }
}