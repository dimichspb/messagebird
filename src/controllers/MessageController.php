<?php
namespace dimichspb\messagebird\controllers;

use dimichspb\messagebird\adapters\MessageBirdClientAdapter;
use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\entities\configuration\AccessKey;
use dimichspb\messagebird\entities\messages\InputMessage;
use dimichspb\messagebird\exceptions\ErrorProcessingMessageException;
use dimichspb\messagebird\parsers\JsonParser;
use dimichspb\messagebird\processors\message\MessageProcessor;
use dimichspb\messagebird\queue\Queue;
use dimichspb\messagebird\queue\workers\MessageWorker;
use dimichspb\messagebird\requests\methods\PostMethod;
use dimichspb\messagebird\requests\RequestInterface;
use dimichspb\messagebird\responses\ResponseInterface;
use dimichspb\messagebird\services\ClientService;
use dimichspb\messagebird\services\MessageService;

class MessageController extends BaseController
{
    protected $service;

    public function __construct(Configurator $configurator, RequestInterface $request = null, ResponseInterface $response = null)
    {
        $clientAdapter = new MessageBirdClientAdapter($configurator);
        $queue = new Queue($configurator);
        $processor = new MessageProcessor($configurator);
        $parser = new JsonParser($configurator);

        $this->service = new MessageService($clientAdapter, $queue, $processor, $parser);

        parent::__construct($configurator, $request, $response);
    }

    public function run()
    {
        $request = $this->request;

        try {
            $this->service->create($request);
        } catch (ErrorProcessingMessageException $exception) {
            return $this->render('error');
        }

        return $this->render('success');
    }

    public function allowedMethods()
    {
        return [
            PostMethod::class
        ];
    }
}