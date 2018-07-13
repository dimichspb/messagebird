<?php
namespace dimichspb\messagebird\commands;

use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\queue\Queue;
use dimichspb\messagebird\requests\RequestInterface;
use dimichspb\messagebird\responses\ResponseInterface;

class QueueCommand extends BaseCommand
{
    protected $queue;

    public function __construct(Configurator $configurator, RequestInterface $request = null, ResponseInterface $response = null)
    {
        $queue = new Queue($configurator);
        $this->queue = $queue;

        parent::__construct($configurator, $request, $response);
    }

    public function getHelp()
    {
        return 'Runs queue';
    }

    public function run()
    {
        return self::class;
    }
}