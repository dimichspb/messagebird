<?php
namespace dimichspb\messagebird\commands;

use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\ControllerInterface;
use dimichspb\messagebird\requests\ConsoleRequest;
use dimichspb\messagebird\requests\RequestInterface;
use dimichspb\messagebird\responses\ConsoleResponse;
use dimichspb\messagebird\responses\ResponseInterface;


/**
 * Class BaseCommand
 * @package dimichspb\messagebird\commands
 */
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

    /**
     * BaseCommand constructor.
     * @param Configurator $configurator
     * @param RequestInterface|null $request
     * @param ResponseInterface|null $response
     */
    public function __construct(Configurator $configurator, RequestInterface $request = null, ResponseInterface $response = null)
    {
        $this->configurator = $configurator;
        $this->request = $request? $request: new ConsoleRequest();
        $this->response = $response? $response: new ConsoleResponse();
    }

    public function aware()
    {

    }
}