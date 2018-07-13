<?php
namespace dimichspb\messagebird\entities;

use dimichspb\messagebird\exceptions\InvalidAttributeNameException;

abstract class Entity
{
    protected $value;

    public function __construct($value)
    {
        $this->assert($value);

        $this->value = $value;
    }

    abstract protected function assert($value);

    public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        return (string)$this->getValue();
    }

    public function __get($name)
    {
        $getter = 'get' . ucfirst($name);

        if (!method_exists($this, $getter)) {
            throw new InvalidAttributeNameException('Attribute ' . $name . ' does not exist in ' . self::class);
        }

        return $this->$getter;
    }
}