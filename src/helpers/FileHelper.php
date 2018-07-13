<?php
namespace dimichspb\messagebird\helpers;

class FileHelper
{
    public static function build($path, $filename)
    {
        return self::parsePath($path) . DIRECTORY_SEPARATOR . self::parseFilename($filename);
    }

    public static function parsePath($path)
    {
        $path = trim($path);
        $path = rtrim($path, " \t\n\r\0\x0B\\\/");

        return $path;
    }

    public static function parseFilename($filename)
    {
        $filename = basename($filename);
        $filename = trim($filename);
        $filename = ltrim($filename, " \t\n\r \v\\\/");

        return $filename;
    }
}