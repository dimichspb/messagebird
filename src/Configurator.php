<?php
namespace dimichspb\messagebird;

use dimichspb\messagebird\exceptions\InvalidConfigItemName;

use dimichspb\messagebird\helpers\AssertHelper;
use dimichspb\messagebird\processors\configuration\FileProcessorInterface;

/**
 * Class Configurator
 * @package dimichspb\messagebird
 */
class Configurator
{
    /**
     * @var array|mixed
     */
    protected $config = [];

    /**
     * Configurator constructor.
     * @param FileProcessorInterface $fileProcessor
     */
    public function __construct(FileProcessorInterface $fileProcessor)
    {
        $this->config = $fileProcessor->getArray();
    }

    /**
     * @param $itemName
     * @return array|mixed
     */
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

    /**
     * @param $name
     * @param array $config
     * @return mixed
     */
    protected function findItem($name, array $config)
    {
        if (!isset($config[$name])) {
            throw new InvalidConfigItemName('Item name ' . $name . ' can not be found in configuration');
        }
        return $config[$name];
    }
}