<?php
namespace dimichspb\messagebird\processors\configuration;

use dimichspb\messagebird\helpers\AssertHelper;

abstract class BaseFileProcessor implements FileProcessorInterface
{
    protected $files = [];
    protected $array = [];

    public function __construct(array $files = [])
    {
        foreach ($files as $file) {
            $this->addFile($file);
        }
    }

    public function addFile(File $file)
    {
        $this->array = array_merge($this->array, $this->loadFile($file));
        $this->files[] = $file;
    }

    public function getArray()
    {
        return $this->array;
    }

    abstract protected function loadFile(File $file);
}