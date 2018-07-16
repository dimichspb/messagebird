<?php
namespace dimichspb\messagebird\middlewares\router;

use dimichspb\messagebird\helpers\AssertHelper;

class Route
{
    const DEFAULT_ROUTE_ALIAS = 'default';

    protected $alias;
    protected $class;

    public function __construct($alias, $class)
    {
        AssertHelper::isString($alias);
        AssertHelper::isString($class);
        AssertHelper::isClassExist($class);

        $this->alias = $alias;
        $this->class = $class;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function getClass()
    {
        return $this->class;
    }
}