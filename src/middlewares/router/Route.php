<?php
namespace dimichspb\messagebird\middlewares\router;

use dimichspb\messagebird\helpers\AssertHelper;

/**
 * Class Route
 * @package dimichspb\messagebird\middlewares\router
 */
class Route
{
    /**
     * Default route alias
     */
    const DEFAULT_ROUTE_ALIAS = 'default';

    /**
     * @var string
     */
    protected $alias;
    /**
     * @var string
     */
    protected $class;

    /**
     * Route constructor.
     * @param $alias
     * @param $class
     */
    public function __construct($alias, $class)
    {
        AssertHelper::isString($alias);
        AssertHelper::isString($class);
        AssertHelper::isClassExist($class);

        $this->alias = $alias;
        $this->class = $class;
    }

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }
}