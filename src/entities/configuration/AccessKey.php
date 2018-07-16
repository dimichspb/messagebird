<?php
namespace dimichspb\messagebird\entities\configuration;

use dimichspb\messagebird\entities\Entity;
use dimichspb\messagebird\exceptions\AssertionException;

/**
 * Class AccessKey
 * @package dimichspb\messagebird\entities\configuration
 */
class AccessKey extends Entity
{
    /**
     * @param $value
     */
    protected function assert($value)
    {
        if (!is_string($value)) {
            throw new AssertionException('AccessKey must be a string');
        }

        $stringLength = strlen($value);

        if ($stringLength !== 25) {
            throw new AssertionException('AccessKey length must be 25 chars, actual length is ' . $stringLength);
        }
    }

}