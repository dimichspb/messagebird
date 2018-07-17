<?php
namespace dimichspb\messagebird\entities\configuration;

use dimichspb\messagebird\entities\Entity;
use dimichspb\messagebird\helpers\AssertHelper;

/**
 * Class MessageSize
 * @package dimichspb\messagebird\entities\configuration
 */
class MessageSize extends Entity
{
    /**
     * @param $value
     */
    protected function assert($value)
    {
        AssertHelper::isInteger($value);
    }

}