<?php
namespace dimichspb\messagebird\adapters;

use Closure;
use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\entities\configuration\AccessKey;
use dimichspb\messagebird\entities\messages\OutputMessage;
use MessageBird\Client;
use MessageBird\Exceptions\AuthenticateException;
use MessageBird\Exceptions\BalanceException;
use MessageBird\Objects\Message;

class MessageBirdClientAdapter implements ClientAdapterInterface
{
    protected $instance;

    protected $access_key;

    public function __construct(Configurator $configurator)
    {
        $this->setAccessKey(new AccessKey($configurator->get('messagebird.access_key')));
    }

    /**
     * @return Client
     */
    public function getInstance()
    {
        if ($this->instance instanceof Client) {
            return $this->instance;
        }

        return $this->instance = new Client($this->access_key);
    }

    public function getBalance()
    {
        return $this->getInstance()->balance->read();
    }

    public function sendMessage(OutputMessage $outputMessage)
    {
        $message = new Message();
        $message->originator = 'MessageBird';
        $message->recipients = [
            $outputMessage->getNumber()->getValue(),
        ];
        $message->body = $outputMessage->getText()->getValue();

        try {
            $result = $this->getInstance()->messages->create($message);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $result;
    }


    public function setAccessKey(AccessKey $accessKey)
    {
        $this->access_key = $accessKey;
    }
}