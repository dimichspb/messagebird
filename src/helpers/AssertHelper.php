<?php
namespace dimichspb\messagebird\helpers;

use dimichspb\messagebird\exceptions\AssertionException;

/**
 * Class AssertHelper
 * @package dimichspb\messagebird\helpers
 */
class AssertHelper
{
    /**
     * @param $value
     * @return bool
     */
    public static function isInteger($value)
    {
        if ($value !== (int)$value || !is_integer($value)) {
            throw new AssertionException('Not an integer');
        }
        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function isString($value)
    {
        if (!is_string($value)) {
            throw new AssertionException('Not a string');
        }
        return true;
    }

    /**
     * @param array $array
     * @param $class
     * @return bool
     */
    public static function isAllInstanceOf(array $array, $class)
    {
        foreach ($array as $item) {
            AssertHelper::isInstanceOf($item, $class);
        }
        return true;
    }

    /**
     * @param $item
     * @param $class
     * @return bool
     */
    public static function isInstanceOf($item, $class)
    {
        if (!$item instanceof $class) {
            throw new AssertionException('Not a ' . $class);
        }

        return true;
    }

    /**
     * @param $array
     * @return bool
     */
    public static function isArray($array)
    {
        if (!is_array($array)) {
            throw new AssertionException('Not an array');
        }
        return true;
    }

    /**
     * @param $item
     * @param array $array
     * @return bool
     */
    public static function isInArray($item, array $array)
    {
        if (!in_array($item, $array)) {
            throw new AssertionException('Not in array');
        }
        return true;
    }

    /**
     * @param $key
     * @param array $array
     * @return bool
     */
    public static function isKeyExist($key, array $array)
    {
        if (!in_array($key, array_keys($array))) {
            throw new AssertionException('Key not in array');
        }
        return true;
    }

    /**
     * @param $class
     * @return bool
     */
    public static function isClassExist($class)
    {
        if (!class_exists($class)) {
            throw new AssertionException('Class does not exist');
        }
        return true;
    }

    /**
     * @param $filename
     * @return bool
     */
    public static function isFileExist($filename)
    {
        if (!file_exists($filename)) {
            throw new AssertionException('File does not exist');
        }
        return true;
    }

    /**
     * @param $directory
     * @return bool
     */
    public static function isDirectoryExist($directory)
    {
        if (!is_dir($directory)) {
            throw new AssertionException('Directory does not exist');
        }
        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function isPhoneNumber($value)
    {
        if (!preg_match('/[0-9]{11}/', $value)) {
            throw new AssertionException('Not a phone number');
        }
        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function isText($value)
    {
        if ($value !== (string)$value || !is_string($value)) {
            throw new AssertionException('Not a text');
        }
        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function isHex($value)
    {
        if (!preg_match('/[0-9A-F]{2}/', strtoupper($value))) {
            throw new AssertionException('Not a hex');
        }
        return true;
    }

    /**
     * @param $value
     * @return bool
     */
    public static function isTrue($value)
    {
        if ($value !== true) {
            throw new AssertionException('Not a true');
        }
        return true;
    }
}