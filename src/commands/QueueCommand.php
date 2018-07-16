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
        $count = $this->queue->count();

        $delay = 1;

        $this->response->writeLine('Queue count: ' . $count);

        set_time_limit(0);

        while (true) {
            $start = microtime(true);
            $this->runQueue();
            $sleepUntil = $start + $delay;
            if ($sleepUntil > microtime(true)) {
                time_sleep_until($start + $delay);
            }
        }
    }

    protected function runQueue()
    {
        if ($result = $this->queue->one()) {
            $this->response->writeLine($result);
            $this->response->writeLine('Done!');
        }
    }
}