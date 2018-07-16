<?php
namespace dimichspb\messagebird\services;

use dimichspb\messagebird\adapters\ClientAdapterInterface;
use dimichspb\messagebird\entities\messages\OutputMessage;

/**
 * Class ClientService
 * @package dimichspb\messagebird\services
 */
class ClientService
{
    /**
     * @var ClientAdapterInterface
     */
    protected $clientAdapter;

    /**
     * ClientService constructor.
     * @param ClientAdapterInterface $clientAdapter
     */
    public function __construct(ClientAdapterInterface $clientAdapter)
    {
        $this->clientAdapter = $clientAdapter;
    }

    /**
     * @return mixed
     */
    public function balance()
    {
        return $this->clientAdapter->getBalance();
    }

    /**
     * @param OutputMessage $message
     * @return mixed
     */
    public function send(OutputMessage $message)
    {
        return $this->clientAdapter->sendMessage($message);
    }
}