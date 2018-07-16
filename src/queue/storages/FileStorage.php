<?php
namespace dimichspb\messagebird\queue\storages;

use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\helpers\AssertHelper;
use dimichspb\messagebird\helpers\FileHelper;

/**
 * Class FileStorage
 * @package dimichspb\messagebird\queue\storages
 */
class FileStorage implements StorageInterface
{
    /**
     * @var string
     */
    protected $filename;

    /**
     * FileStorage constructor.
     * @param Configurator $configurator
     */
    public function __construct(Configurator $configurator)
    {
        $filename = $configurator->get('storage.filename');

        $path = dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . FileHelper::parsePath(dirname($filename));
        $filename = FileHelper::parseFilename($filename);

        AssertHelper::isDirectoryExist($path);

        $this->filename = FileHelper::build($path, $filename);

        if (!file_exists($this->filename)) {
            file_put_contents($this->filename, '');
        }
    }

    /**
     * @return bool|string
     */
    public function getData()
    {
        $contents = file_get_contents($this->filename);

        return $contents? $contents: '';
    }

    /**
     * @param $data
     * @return bool|int
     */
    public function saveData($data)
    {
        return file_put_contents($this->filename, $data);
    }


}