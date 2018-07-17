<?php
namespace dimichspb\messagebird\tests\adapters;

use dimichspb\messagebird\adapters\ClientAdapterInterface;
use dimichspb\messagebird\adapters\MessageBirdClientAdapter;
use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\entities\messages\Number;
use dimichspb\messagebird\entities\messages\OutputMessage;
use dimichspb\messagebird\entities\messages\Text;
use MessageBird\Client;
use MessageBird\Objects\Message;
use MessageBird\Resources\Balance;
use MessageBird\Resources\Messages;

class MessageBirdClientAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MessageBirdClientAdapter
     */
    protected $adapter;

    /**
     * @var Client
     */
    protected $client;

    protected $accessKey = 'aabbccddeeffaabbccddeeff0';

    public function setUp()
    {
        $messagesMock = $this->getMockBuilder(Messages::class)->disableOriginalConstructor()->getMock();
        $messagesMock->method('create')->willReturn('success');
        $balanceMock = $this->getMockBuilder(Balance::class)->disableOriginalConstructor()->getMock();
        $balanceMock->method('read')->willReturn(0);

        $clientMock = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $clientMock->messages = $messagesMock;
        $clientMock->balance = $balanceMock;

        $this->client = $clientMock;

        $this->adapter = new MessageBirdClientAdapter($clientMock);
    }

    public function testGetBalance()
    {
        $this->assertSame($this->adapter->getBalance(), 0);
    }


    public function testSendMessage()
    {
        $message = new OutputMessage(
            new Number('01234567890'),
            new Text('This is out top important test message')
        );

        $this->assertSame($this->adapter->sendMessage($message), 'success');
    }

    public function test__construct()
    {
        $reflector = new \ReflectionClass($this->adapter);
        $property = $reflector->getProperty('client');
        $property->setAccessible(true);
        $client = $property->getValue($this->adapter);

        $this->assertSame($client, $this->client);
    }

    public function testCreateMessage()
    {
        $message = new Message();
        $message->originator = 'MessageBird';
        $message->recipients = [
            '01234567891',
        ];
        $message->body = 'This is test message text';

        $this->assertSame($this->adapter->createMessage($message), 'success');
    }
}
