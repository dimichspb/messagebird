<?php
namespace dimichspb\messagebird;


use dimichspb\messagebird\exceptions\InvalidConfigItemName;
use dimichspb\messagebird\exceptions\InvalidConfigurationException;

class Configurator
{
    protected $configPath;
    protected $configFileName;
    protected $localConfigFileName;

    protected $config = [];

    public function __construct($configPath, $configFileName, $localConfigFileName = null)
    {
        $configFilePath = $this->buildFilePath($configPath, $configFileName);
        $localConfigFilePath = $localConfigFileName? $this->buildFilePath($configPath, $localConfigFileName): null;

        $config = $this->loadConfigFile($configFilePath);

        if ($localConfigFilePath && file_exists($localConfigFilePath)) {
            $config = array_merge($config, $this->loadConfigFile($localConfigFileName));
        }

        $this->config = $config;
    }

    public function get($itemName)
    {
        if (!is_string($itemName)) {
            throw new \InvalidArgumentException('Configuration item name must be a string');
        }
        $names = explode('.', $itemName);

        $item = $this->config;

        foreach ($names as $name) {
            $item = $this->findItem($name, $item);
            if (!is_array($item)) {
                break;
            }
        }

        if (!is_string($item)) {
            throw new InvalidConfigItemName('Item name ' . $itemName . ' can not be found in configuraton file');
        }

        return $item;
    }

    protected function findItem($name, array $config)
    {
        if (!isset($config[$name])) {
            throw new InvalidConfigItemName('Item name ' . $name . ' can not be found in configuration file');
        }
        return $config[$name];
    }

    protected function buildFilePath($path, $fileName)
    {
        if (!is_string($path) || !is_string($fileName)) {
            throw new \InvalidArgumentException('Both arguments must be strings');
        }

        return $path . DIRECTORY_SEPARATOR . $fileName;
    }

    protected function loadConfigFile($filePath)
    {
        if (!file_exists($filePath)) {
            throw new InvalidConfigurationException('File ' . $filePath . ' does not exist');
        }

        $config = parse_ini_file($filePath, true);

        if ($config === false) {
            throw new InvalidConfigurationException('Invalid format of ' . $filePath . ' configuration file');
        }

        return $config;
    }
}