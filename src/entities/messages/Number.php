<?php
namespace dimichspb\messagebird\entities\messages;

use dimichspb\messagebird\entities\Entity;
use dimichspb\messagebird\helpers\AssertHelper;

class Number extends Entity
{
    protected function assert($value)
    {
        AssertHelper::isPhoneNumber($value);
    }
}