<?php
namespace dimichspb\messagebird;

use dimichspb\messagebird\exceptions\InvalidConfigItemName;
use dimichspb\messagebird\exceptions\InvalidConfigurationException;
use dimichspb\messagebird\helpers\AssertHelper;
use dimichspb\messagebird\processors\configuration\FileProcessorInterface;

class Configurator
{
    protected $config = [];

    public function __construct(FileProcessorInterface $fileProcessor)
    {
        $this->config = $fileProcessor->getArray();
    }

    public function get($itemName)
    {
        AssertHelper::isString($itemName);

        $names = explode('.', $itemName);

        $item = $this->config;

        foreach ($names as $name) {
            $item = $this->findItem($name, $item);
            if (!is_array($item)) {
                break;
            }
        }

        return $item;
    }

    protected function findItem($name, array $config)
    {
        if (!isset($config[$name])) {
            throw new InvalidConfigItemName('Item name ' . $name . ' can not be found in configuration');
        }
        return $config[$name];
    }
}