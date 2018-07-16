<?php
namespace dimichspb\messagebird\entities;

use dimichspb\messagebird\helpers\AssertHelper;

class HexEntity extends Entity
{
    public function __construct($value)
    {
        $value = str_pad($value, 2, '0', STR_PAD_LEFT);
        parent::__construct($value);
    }

    protected function assert($value)
    {
        AssertHelper::isHex($value);
    }

}