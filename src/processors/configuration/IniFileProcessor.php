<?php
namespace dimichspb\messagebird\processors\configuration;

class IniFileProcessor extends BaseFileProcessor
{
    protected function loadFile(File $file)
    {
        return parse_ini_file($file->getFullPath(), true);
    }
}