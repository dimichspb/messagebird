<?php
namespace dimichspb\messagebird\entities\messages\udh;

use dimichspb\messagebird\entities\HexEntity;


/**
 * Class Identifier
 * @package dimichspb\messagebird\entities\messages\udh
 */
class Identifier extends HexEntity
{
    /**
     * @return Identifier
     */
    public static function createDefault()
    {
        return new static('00');
    }

}