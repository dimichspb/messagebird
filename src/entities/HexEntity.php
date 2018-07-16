<?php
namespace dimichspb\messagebird\entities;

use dimichspb\messagebird\helpers\AssertHelper;

/**
 * Class HexEntity
 * @package dimichspb\messagebird\entities
 */
abstract class HexEntity extends Entity
{
    /**
     * HexEntity constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $value = str_pad($value, 2, '0', STR_PAD_LEFT);
        parent::__construct($value);
    }

    /**
     * @param $value
     * @return mixed|void
     */
    protected function assert($value)
    {
        AssertHelper::isHex($value);
    }

}