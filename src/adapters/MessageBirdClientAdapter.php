<?php
namespace dimichspb\messagebird\adapters;


use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\entities\configuration\AccessKey;
use dimichspb\messagebird\entities\messages\OutputMessage;
use MessageBird\Client;


use MessageBird\Objects\Message;

/**
 * Class MessageBirdClientAdapter
 * @package dimichspb\messagebird\adapters
 */
class MessageBirdClientAdapter implements ClientAdapterInterface
{
    /**
     * @var
     */
    protected $instance;

    /**
     * @var
     */
    protected $access_key;

    /**
     * MessageBirdClientAdapter constructor.
     * @param Configurator $configurator
     */
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

    /**
     * @return \MessageBird\Resources\Balance|mixed
     * @throws \MessageBird\Exceptions\RequestException
     * @throws \MessageBird\Exceptions\ServerException
     */
    public function getBalance()
    {
        return $this->getInstance()->balance->read();
    }

    /**
     * @param OutputMessage $outputMessage
     * @return \MessageBird\Objects\Balance|\MessageBird\Objects\Hlr|\MessageBird\Objects\Lookup|Message|\MessageBird\Objects\Verify|\MessageBird\Objects\VoiceMessage|mixed|string
     */
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


    /**
     * @param AccessKey $accessKey
     */
    public function setAccessKey(AccessKey $accessKey)
    {
        $this->access_key = $accessKey;
    }
}