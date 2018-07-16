<?php
namespace dimichspb\messagebird\entities\messages\udh;

use dimichspb\messagebird\entities\HexEntity;


/**
 * Class Count
 * @package dimichspb\messagebird\entities\messages\udh
 */
class Count extends HexEntity
{
    /**
     * @return Count
     */
    public static function createDefault()
    {
        return new static('01');
    }
}