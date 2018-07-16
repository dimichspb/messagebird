<?php
namespace dimichspb\messagebird\processors\configuration;

/**
 * Class IniFileProcessor
 * @package dimichspb\messagebird\processors\configuration
 */
class IniFileProcessor extends BaseFileProcessor
{
    /**
     * @param File $file
     * @return array|bool|mixed
     */
    protected function loadFile(File $file)
    {
        return parse_ini_file($file->getFullPath(), true);
    }
}