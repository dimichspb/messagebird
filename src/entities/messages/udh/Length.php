<?php
namespace dimichspb\messagebird\entities\messages\udh;

use dimichspb\messagebird\entities\HexEntity;


/**
 * Class Length
 * @package dimichspb\messagebird\entities\messages\udh
 */
class Length extends HexEntity
{
    /**
     * @return Length
     */
    public static function createDefault()
    {
        return new static('05');
    }

}