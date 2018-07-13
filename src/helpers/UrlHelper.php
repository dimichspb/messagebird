<?php
namespace dimichspb\messagebird\helpers;

class UrlHelper
{
    public static function parseUrl($url)
    {
        $url = trim($url, " \t\n\r\0\x0B\\\/");

        return $url;
    }
}