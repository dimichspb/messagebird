<?php
namespace dimichspb\messagebird\queue\workers;

/**
 * Interface WorkerInterface
 * @package dimichspb\messagebird\queue\workers
 */
interface WorkerInterface
{
    /**
     * @return mixed
     */
    public function run();
}