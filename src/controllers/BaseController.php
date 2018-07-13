<?php
namespace dimichspb\messagebird\controllers;

use dimichspb\messagebird\ControllerInterface;
use dimichspb\messagebird\exceptions\MethodNotAllowedException;
use dimichspb\messagebird\helpers\FileHelper;
use dimichspb\messagebird\requests\HttpRequest;
use dimichspb\messagebird\requests\RequestInterface;
use dimichspb\messagebird\responses\HttpResponse;
use dimichspb\messagebird\responses\ResponseInterface;
use dimichspb\messagebird\Configurator;
use ReflectionClass;

abstract class BaseController implements ControllerInterface
{
    /**
     * @var Configurator
     */
    protected $configurator;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    public function __construct(Configurator $configurator, RequestInterface $request = null, ResponseInterface $response = null)
    {
        $this->configurator = $configurator;
        $this->request = $request? $request: new HttpRequest();
        $this->response = $response? $response: new HttpResponse();
    }

    public function aware()
    {
        if (!in_array($this->request->getMethod(), $this->allowedMethods())) {
            throw new MethodNotAllowedException('Method not allowed');
        }
    }

    protected function render($view)
    {
        return $this->getView($view);
    }

    protected function getView($view)
    {
        $viewPath = $this->getViewPath($view, $this->getShortName());

        return file_get_contents($viewPath);
    }

    protected function getViewPath($view, $controllerShortName)
    {
        return FileHelper::build(
            dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $controllerShortName,
            $view . '.php'
        );
    }

    protected function getShortName()
    {
        $reflection = new \ReflectionClass(static::class);
        $shortName = $reflection->getShortName();

        return lcfirst(str_replace('Controller', '', $shortName));
    }

    abstract public function allowedMethods();

}