<?php
namespace dimichspb\messagebird\entities\configuration;

use dimichspb\messagebird\entities\Entity;
use dimichspb\messagebird\helpers\AssertHelper;

class TimeOut extends Entity
{
    protected function assert($value)
    {
        AssertHelper::isInteger($value);
    }

}