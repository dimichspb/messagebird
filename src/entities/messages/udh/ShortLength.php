<?php
namespace dimichspb\messagebird\entities\messages\udh;

use dimichspb\messagebird\entities\HexEntity;


/**
 * Class ShortLength
 * @package dimichspb\messagebird\entities\messages\udh
 */
class ShortLength extends HexEntity
{
    /**
     * @return ShortLength
     */
    public static function createDefault()
    {
        return new static('03');
    }
}