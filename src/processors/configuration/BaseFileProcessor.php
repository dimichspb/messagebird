<?php
namespace dimichspb\messagebird\processors\configuration;


/**
 * Class BaseFileProcessor
 * @package dimichspb\messagebird\processors\configuration
 */
abstract class BaseFileProcessor implements FileProcessorInterface
{
    /**
     * @var array
     */
    protected $files = [];
    /**
     * @var array
     */
    protected $array = [];

    /**
     * BaseFileProcessor constructor.
     * @param array $files
     */
    public function __construct(array $files = [])
    {
        foreach ($files as $file) {
            $this->addFile($file);
        }
    }

    /**
     * @param File $file
     */
    public function addFile(File $file)
    {
        $this->array = array_merge($this->array, $this->loadFile($file));
        $this->files[] = $file;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        return $this->array;
    }

    /**
     * @param File $file
     * @return mixed
     */
    abstract protected function loadFile(File $file);
}