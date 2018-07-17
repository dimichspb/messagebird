<?php
/**
 * Created by PhpStorm.
 * User: dtaranti
 * Date: 17.07.2018
 * Time: 13:12
 */

namespace dimichspb\messagebird\tests\entities;

use dimichspb\messagebird\entities\HexEntity;
use dimichspb\messagebird\exceptions\AssertionException;

class HexEntityTest extends \PHPUnit_Framework_TestCase
{
    public function test__constructSuccess()
    {
        $hexEntity = new TestableHexEntity('FF');

        $this->assertSame($hexEntity->getValue(), 'FF');
    }

    public function test__constructExceptionThrown()
    {
        $this->setExpectedException(AssertionException::class);

        $hexEntity = new TestableHexEntity('ZZ');
    }
}

class TestableHexEntity extends HexEntity
{
}
