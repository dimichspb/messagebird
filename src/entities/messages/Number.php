<?php
namespace dimichspb\messagebird\entities\messages;

use dimichspb\messagebird\entities\Entity;
use dimichspb\messagebird\helpers\AssertHelper;

/**
 * Class Number
 * @package dimichspb\messagebird\entities\messages
 */
class Number extends Entity
{
    /**
     * @param $value
     */
    protected function assert($value)
    {
        AssertHelper::isPhoneNumber($value);
    }
}