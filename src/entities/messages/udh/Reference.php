<?php
namespace dimichspb\messagebird\entities\messages\udh;

use dimichspb\messagebird\entities\HexEntity;


/**
 * Class Reference
 * @package dimichspb\messagebird\entities\messages\udh
 */
class Reference extends HexEntity
{
    /**
     * @return Reference
     */
    public static function createDefault()
    {
        return new static('CC');
    }
}