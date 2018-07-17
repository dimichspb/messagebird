<?php
namespace dimichspb\messagebird\controllers;

use dimichspb\messagebird\adapters\MessageBirdClientAdapter;
use dimichspb\messagebird\Configurator;


use dimichspb\messagebird\exceptions\ErrorProcessingMessageException;
use dimichspb\messagebird\parsers\JsonParser;
use dimichspb\messagebird\processors\message\MessageProcessor;
use dimichspb\messagebird\queue\Queue;

use dimichspb\messagebird\requests\methods\PostMethod;
use dimichspb\messagebird\requests\RequestInterface;
use dimichspb\messagebird\responses\ResponseInterface;

use dimichspb\messagebird\services\MessageService;
use MessageBird\Client;

/**
 * Class MessageController
 * @package dimichspb\messagebird\controllers
 */
class MessageController extends BaseController
{
    /**
     * @var MessageService
     */
    protected $service;

    /**
     * MessageController constructor.
     * @param Configurator $configurator
     * @param RequestInterface|null $request
     * @param ResponseInterface|null $response
     */
    public function __construct(Configurator $configurator, RequestInterface $request = null, ResponseInterface $response = null)
    {
        $client = new Client($configurator->get('messagebird.access_key'));
        $clientAdapter = new MessageBirdClientAdapter($client);
        $queue = new Queue($configurator);
        $processor = new MessageProcessor($configurator);
        $parser = new JsonParser($configurator);

        $this->service = new MessageService($clientAdapter, $queue, $processor, $parser);

        parent::__construct($configurator, $request, $response);
    }

    /**
     * @return bool|string
     */
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

    /**
     * @return array|mixed
     */
    public function allowedMethods()
    {
        return [
            PostMethod::class
        ];
    }
}