<?php
namespace dimichspb\messagebird\commands;

/**
 * Class DefaultCommand
 * @package dimichspb\messagebird\commands
 */
class DefaultCommand extends BaseCommand
{
    /**
     * @return string
     */

    public function run()
    {
        return self::class;
    }
}