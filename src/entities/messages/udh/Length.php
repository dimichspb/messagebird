<?php
namespace dimichspb\messagebird\entities\messages\udh;

use dimichspb\messagebird\entities\HexEntity;
use dimichspb\messagebird\helpers\AssertHelper;

class Length extends HexEntity
{
    public static function createDefault()
    {
        return new static('05');
    }

}