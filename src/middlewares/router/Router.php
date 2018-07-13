<?php
namespace dimichspb\messagebird\middlewares\router;

use dimichspb\messagebird\helpers\AssertHelper;
use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\ControllerInterface;
use dimichspb\messagebird\exceptions\RouteNotFoundException;
use dimichspb\messagebird\middlewares\MiddlewareInterface;
use dimichspb\messagebird\requests\RequestInterface;
use dimichspb\messagebird\responses\ResponseInterface;

class Router implements MiddlewareInterface
{
    protected $configurator;

    /**
     * @var Route[]
     */
    protected $routes = [];

    public function __construct(Configurator $configurator, $settings)
    {
        $this->configurator = $configurator;

        AssertHelper::isString($settings);

        $this->setRoutes($this->createRoutes($configurator->get($settings)));
    }

    public function setRoutes(array $routes = [])
    {
        AssertHelper::isAllInstanceOf($routes, Route::class);

        $this->routes = $routes;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getRoute($alias)
    {
        foreach ($this->routes as $route)
        {
            if ($route->getAlias() === $alias) {
                return $route;
            }
        }

        throw new RouteNotFoundException('Route with alias ' . $alias . ' does not exist');
    }

    public function createRoutes(array $definitions = [])
    {
        $routes = [];
        foreach ($definitions as $name => $class) {
            $routes[] = new Route($name, $class);
        }

        return $routes;
    }

    public function addRoute(Route $route)
    {
        $this->routes[] = $route;
    }

    public function setDefaultRoute($class)
    {
        $this->addRoute(new Route('default', $class));
    }

    protected function isRouteExist($alias)
    {
        foreach ($this->routes as $route)
        {
            if ($route->getAlias() === $alias) {
                return true;
            }
        }

        return false;
    }

    public function process(RequestInterface $request, ResponseInterface $response)
    {
        $controller = $this->getController($request, $response);

        $controller->aware();

        $response->setBody($controller->run());
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return ControllerInterface
     */
    protected function getController(RequestInterface $request, ResponseInterface $response)
    {
        $alias = $request->getAlias();

        if (!$alias) {
            $alias = 'default';
        }

        $route = $this->getRoute($alias);
        $class = $route->getClass();

        return new $class($this->configurator, $request, $response);
    }
}