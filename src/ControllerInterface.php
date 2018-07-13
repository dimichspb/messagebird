<?php
namespace dimichspb\messagebird;

use dimichspb\messagebird\requests\RequestInterface;
use dimichspb\messagebird\responses\ResponseInterface;

interface ControllerInterface
{
    public function __construct(Configurator $configurator, RequestInterface $request, ResponseInterface $response);

    public function aware();
    public function run();
}