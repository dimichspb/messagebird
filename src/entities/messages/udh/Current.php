<?php
namespace dimichspb\messagebird\entities\messages\udh;

use dimichspb\messagebird\entities\HexEntity;


/**
 * Class Current
 * @package dimichspb\messagebird\entities\messages\udh
 */
class Current extends HexEntity
{
    /**
     * @return Current
     */
    public static function createDefault()
    {
        return new static('01');
    }
}