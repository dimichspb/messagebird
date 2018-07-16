<?php
namespace dimichspb\messagebird\queue\storages;

/**
 * Interface StorageInterface
 * @package dimichspb\messagebird\queue\storages
 */
interface StorageInterface
{
    /**
     * @return mixed
     */
    public function getData();

    /**
     * @param $data
     * @return mixed
     */
    public function saveData($data);
}