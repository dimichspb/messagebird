<?php
namespace dimichspb\messagebird\processors\configuration;

interface FileProcessorInterface
{
    public function addFile(File $file);
    public function getArray();
}