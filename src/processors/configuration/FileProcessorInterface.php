<?php
namespace dimichspb\messagebird\processors\configuration;

/**
 * Interface FileProcessorInterface
 * @package dimichspb\messagebird\processors\configuration
 */
interface FileProcessorInterface
{
    /**
     * @param File $file
     * @return mixed
     */
    public function addFile(File $file);

    /**
     * @return mixed
     */
    public function getArray();
}