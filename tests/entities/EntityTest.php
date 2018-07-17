<?php
/**
 * Created by PhpStorm.
 * User: dtaranti
 * Date: 17.07.2018
 * Time: 12:47
 */

namespace dimichspb\messagebird\tests\entities;

use dimichspb\messagebird\entities\Entity;
use dimichspb\messagebird\exceptions\AssertionException;
use dimichspb\messagebird\exceptions\InvalidAttributeNameException;

class EntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TestableEntity
     */
    protected $entity;

    public function setUp()
    {
        $this->entity = new TestableEntity('value');
    }

    public function test__toString()
    {
        $this->assertSame((string)$this->entity, 'value');
    }

    public function test__getSuccess()
    {
        $this->assertSame($this->entity->value, 'value');
    }

    public function test__getExceptionThrown()
    {
        $this->setExpectedException(InvalidAttributeNameException::class);

        $this->assertSame($this->entity->nothing, 'value');
    }

    public function test__construct()
    {
        $reflection = new \ReflectionClass($this->entity);
        $property = $reflection->getProperty('value');
        $property->setAccessible(true);

        $this->assertSame('value', $property->getValue($this->entity));
    }

    public function testGetValue()
    {
        $this->assertSame($this->entity->getValue(), 'value');
    }
}

class TestableEntity extends Entity
{
    protected function assert($value)
    {
        return true;
    }
}