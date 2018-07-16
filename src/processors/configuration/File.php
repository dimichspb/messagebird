<?php
namespace dimichspb\messagebird\processors\configuration;

use dimichspb\messagebird\helpers\AssertHelper;
use dimichspb\messagebird\helpers\FileHelper;

/**
 * Class File
 * @package dimichspb\messagebird\processors\configuration
 */
class File
{
    /**
     * @var string
     */
    protected $fullPath;
    /**
     * @var string
     */
    protected $path;
    /**
     * @var string
     */
    protected $filename;

    /**
     * File constructor.
     * @param $path
     * @param $filename
     */
    public function __construct($path, $filename)
    {
        $filenameWithPath = FileHelper::build($path, $filename);

        AssertHelper::isFileExist($filenameWithPath);

        $this->path = FileHelper::parsePath($path);
        $this->filename = FileHelper::parseFilename($path);
        $this->fullPath = $filenameWithPath;
    }

    /**
     * @return string
     */
    public function getFullPath()
    {
        return $this->fullPath;
    }
}