<?php
namespace dimichspb\messagebird\queue\workers;

interface WorkerInterface
{
    public function run();
}