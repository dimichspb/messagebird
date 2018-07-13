<?php
namespace dimichspb\messagebird\commands;

use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\ControllerInterface;
use dimichspb\messagebird\requests\ConsoleRequest;
use dimichspb\messagebird\requests\RequestInterface;
use dimichspb\messagebird\responses\ConsoleResponse;
use dimichspb\messagebird\responses\ResponseInterface;
use ReflectionClass;

abstract class BaseCommand implements ControllerInterface
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var Configurator
     */
    protected $configurator;

    public function __construct(Configurator $configurator, RequestInterface $request = null, ResponseInterface $response = null)
    {
        $this->configurator = $configurator;
        $this->request = $request? $request: new ConsoleRequest();
        $this->response = $response? $response: new ConsoleResponse();
    }

    abstract public function getHelp();

    public function aware()
    {

    }
}