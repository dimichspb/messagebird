<?php
namespace dimichspb\messagebird\helpers;

use dimichspb\messagebird\exceptions\AssertionException;

class AssertHelper
{
    public static function isInteger($value)
    {
        if (!is_integer($value)) {
            throw new AssertionException('Not an integer');
        }
        return true;
    }
    public static function isString($value)
    {
        if (!is_string($value)) {
            throw new AssertionException('Not a string');
        }
        return true;
    }

    public static function isAllInstanceOf(array $array, $class)
    {
        foreach ($array as $item) {
            AssertHelper::isInstanceOf($item, $class);
        }
        return true;
    }

    public static function isInstanceOf($item, $class)
    {
        if (!$item instanceof $class) {
            throw new AssertionException('Not a ' . $class);
        }

        return true;
    }

    public static function isArray($array)
    {
        if (!is_array($array)) {
            throw new AssertionException('Not an array');
        }
        return true;
    }

    public static function isInArray($item, array $array)
    {
        if (!in_array($item, $array)) {
            throw new AssertionException('Not in array');
        }
        return true;
    }

    public static function isKeyExist($key, array $array)
    {
        if (!is_array(array_keys($array))) {
            throw new AssertionException('Key not in array');
        }
        return true;
    }

    public static function isClassExist($class)
    {
        if (!class_exists($class)) {
            throw new AssertionException('Class does not exist');
        }
        return true;
    }

    public static function isFileExist($filename)
    {
        if (!file_exists($filename)) {
            throw new AssertionException('File does not exist');
        }
        return true;
    }

    public static function isDirectoryExist($directory)
    {
        if (!is_dir($directory)) {
            throw new AssertionException('Directory does not exist');
        }
        return true;
    }

    public static function isPhoneNumber($value)
    {
        if (!preg_match('/[0-9]{11}/', $value)) {
            throw new AssertionException('Not a phone number');
        }
        return true;
    }

    public static function isText($value)
    {
        if (!is_string($value)) {
            throw new AssertionException('Not a text');
        }
        return true;
    }
}