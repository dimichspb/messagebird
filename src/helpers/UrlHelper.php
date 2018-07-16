<?php
namespace dimichspb\messagebird\helpers;

/**
 * Class UrlHelper
 * @package dimichspb\messagebird\helpers
 */
class UrlHelper
{
    /**
     * @param $url
     * @return string
     */
    public static function parseUrl($url)
    {
        $url = trim($url, " \t\n\r\0\x0B\\\/");

        return $url;
    }
}