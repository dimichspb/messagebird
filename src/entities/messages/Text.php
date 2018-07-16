<?php
namespace dimichspb\messagebird\entities\messages;

use dimichspb\messagebird\entities\Entity;
use dimichspb\messagebird\helpers\AssertHelper;

/**
 * Class Text
 * @package dimichspb\messagebird\entities\messages
 */
class Text extends Entity
{
    /**
     * @param $value
     */
    protected function assert($value)
    {
        AssertHelper::isText($value);
    }

}