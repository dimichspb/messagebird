<?php
namespace dimichspb\messagebird\helpers;

/**
 * Class FileHelper
 * @package dimichspb\messagebird\helpers
 */
class FileHelper
{
    /**
     * @param $path
     * @param $filename
     * @return string
     */
    public static function build($path, $filename)
    {
        return self::parsePath($path) . DIRECTORY_SEPARATOR . self::parseFilename($filename);
    }

    /**
     * @param $path
     * @return string
     */
    public static function parsePath($path)
    {
        $path = trim($path);
        $path = rtrim($path, " \t\n\r\0\x0B\\\/");

        return $path;
    }

    /**
     * @param $filename
     * @return string
     */
    public static function parseFilename($filename)
    {
        $filename = basename($filename);
        $filename = trim($filename);
        $filename = ltrim($filename, " \t\n\r \v\\\/");

        return $filename;
    }
}