<?php
namespace dimichspb\messagebird\entities;

use dimichspb\messagebird\exceptions\InvalidAttributeNameException;

/**
 * Class Entity
 * @package dimichspb\messagebird\entities
 */
abstract class Entity
{
    /**
     * @var
     */
    protected $value;

    /**
     * Entity constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->assert($value);

        $this->value = $value;
    }

    /**
     * @param $value
     * @return mixed
     */
    abstract protected function assert($value);

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getValue();
    }

    /**
     * @param $name
     * @return mixed
     * @throws InvalidAttributeNameException
     */
    public function __get($name)
    {
        $getter = 'get' . ucfirst($name);

        if (!method_exists($this, $getter)) {
            throw new InvalidAttributeNameException('Attribute ' . $name . ' does not exist in ' . self::class);
        }

        return $this->$getter;
    }
}