<?php
namespace dimichspb\messagebird\queue\storages;

use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\helpers\AssertHelper;
use dimichspb\messagebird\helpers\FileHelper;

class FileStorage implements StorageInterface
{
    protected $filename;

    public function __construct(Configurator $configurator)
    {
        $filename = $configurator->get('storage.filename');

        $path = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . FileHelper::parsePath(dirname($filename));
        $filename = FileHelper::parseFilename($filename);

        AssertHelper::isDirectoryExist($path);

        $this->filename = FileHelper::build($path, $filename);
    }

    public function getData()
    {
        return file_get_contents($this->filename);
    }

    public function saveData($data)
    {
        return file_put_contents($this->filename, $data);
    }


}