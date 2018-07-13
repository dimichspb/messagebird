<?php
namespace dimichspb\messagebird\controllers;

use dimichspb\messagebird\adapters\MessageBirdClientAdapter;
use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\entities\configuration\AccessKey;
use dimichspb\messagebird\queue\Queue;
use dimichspb\messagebird\queue\workers\MessageWorker;
use dimichspb\messagebird\requests\methods\PostMethod;
use dimichspb\messagebird\requests\RequestInterface;
use dimichspb\messagebird\responses\ResponseInterface;
use dimichspb\messagebird\services\ClientService;

class MessageController extends BaseController
{
    protected $queue;
    protected $clientAdapter;


    public function __construct(Configurator $configurator, RequestInterface $request = null, ResponseInterface $response = null)
    {
        $this->queue = new Queue($configurator);

        $clientAdapter = new MessageBirdClientAdapter();
        $clientAdapter->setAccessKey(new AccessKey($configurator->get('messagebird.access_key')));

        $this->clientAdapter = $clientAdapter;

        parent::__construct($configurator, $request, $response);
    }

    public function run()
    {
        $worker = new MessageWorker($this->clientAdapter);
        $this->queue->add($worker);
    }

    public function allowedMethods()
    {
        return [
            PostMethod::class
        ];
    }
}