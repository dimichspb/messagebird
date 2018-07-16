<?php
namespace dimichspb\messagebird;

use dimichspb\messagebird\requests\RequestInterface;
use dimichspb\messagebird\responses\ResponseInterface;

/**
 * Interface ControllerInterface
 * @package dimichspb\messagebird
 */
interface ControllerInterface
{
    /**
     * ControllerInterface constructor.
     * @param Configurator $configurator
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(Configurator $configurator, RequestInterface $request, ResponseInterface $response);

    /**
     * @return mixed
     */
    public function aware();

    /**
     * @return mixed
     */
    public function run();
}