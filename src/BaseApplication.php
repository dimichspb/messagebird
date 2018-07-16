<?php
namespace dimichspb\messagebird;

use dimichspb\messagebird\adapters\MessageBirdClientAdapter;
use dimichspb\messagebird\entities\configuration\AccessKey;
use dimichspb\messagebird\exceptions\RouteNotFoundException;
use dimichspb\messagebird\helpers\AssertHelper;
use dimichspb\messagebird\middlewares\MiddlewareInterface;
use dimichspb\messagebird\requests\RequestInterface;
use dimichspb\messagebird\responses\ResponseInterface;
use MessageBird\Client;
use ReflectionClass;

abstract class BaseApplication
{
    /**
     * @var MiddlewareInterface[]
     */
    protected $middlewares = [];

    public function __construct(array $middlewares = [])
    {
        AssertHelper::isAllInstanceOf($middlewares, MiddlewareInterface::class);
        $this->middlewares = $middlewares;
    }

    public function addMiddleware(MiddlewareInterface $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    protected function processMiddleware(MiddlewareInterface $middleware, RequestInterface $request, ResponseInterface $response)
    {
        $middleware->process($request, $response);
    }

    public function run()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();

        try {
            foreach ($this->middlewares as $middleware) {
                $this->processMiddleware($middleware, $request, $response);
            }
        } catch (\Exception $exception) {
            $response->setBody($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
        }

        echo $response->getBody();
    }

    /**
     * @return RequestInterface
     */
    abstract public function getRequest();

    /**
     * @return ResponseInterface
     */
    abstract public function getResponse();
}