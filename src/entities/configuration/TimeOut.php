<?php
namespace dimichspb\messagebird\entities\configuration;

use dimichspb\messagebird\entities\Entity;
use dimichspb\messagebird\helpers\AssertHelper;

/**
 * Class TimeOut
 * @package dimichspb\messagebird\entities\configuration
 */
class TimeOut extends Entity
{

    /**
     * @param $value
     * @return mixed|void
     */
    protected function assert($value)
    {
        AssertHelper::isInteger($value);
    }

}