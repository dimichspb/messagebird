<?php
namespace dimichspb\messagebird\processors\configuration;

use dimichspb\messagebird\helpers\AssertHelper;
use dimichspb\messagebird\helpers\FileHelper;

class File
{
    protected $fullPath;
    protected $path;
    protected $filename;

    public function __construct($path, $filename)
    {
        $filenameWithPath = FileHelper::build($path, $filename);

        AssertHelper::isFileExist($filenameWithPath);

        $this->path = FileHelper::parsePath($path);
        $this->filename = FileHelper::parseFilename($path);
        $this->fullPath = $filenameWithPath;
    }

    public function getFullPath()
    {
        return $this->fullPath;
    }
}