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
     * @var Client
     */
    protected $client;

    /**
     * MessageBirdClientAdapter constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return \MessageBird\Resources\Balance|mixed
     * @throws \MessageBird\Exceptions\RequestException
     * @throws \MessageBird\Exceptions\ServerException
     */
    public function getBalance()
    {
        return $this->client->balance->read();
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
            $result = $this->createMessage($message);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $result;
    }


    /**
     * @param Message $message
     * @return \MessageBird\Objects\Balance|\MessageBird\Objects\Hlr|\MessageBird\Objects\Lookup|Message|\MessageBird\Objects\Verify|\MessageBird\Objects\VoiceMessage
     * @throws \MessageBird\Exceptions\HttpException
     * @throws \MessageBird\Exceptions\RequestException
     * @throws \MessageBird\Exceptions\ServerException
     */
    public function createMessage(Message $message)
    {
        return $this->client->messages->create($message);
    }
}