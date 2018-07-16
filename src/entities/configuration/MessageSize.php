<?php
namespace dimichspb\messagebird\entities\configuration;

use dimichspb\messagebird\entities\Entity;
use dimichspb\messagebird\helpers\AssertHelper;

class MessageSize extends Entity
{
    protected function assert($value)
    {
        $value = (int)$value;
        AssertHelper::isInteger($value);
    }

}