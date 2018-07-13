<?php
namespace dimichspb\messagebird\queue\storages;

interface StorageInterface
{
    public function getData();
    public function saveData($data);
}