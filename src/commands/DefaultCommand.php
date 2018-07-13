<?php
namespace dimichspb\messagebird\commands;

class DefaultCommand extends BaseCommand
{
    public function getHelp()
    {
        return 'Default command';
    }

    public function run()
    {
        return self::class;
    }
}