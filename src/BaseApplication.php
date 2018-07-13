<?php
namespace dimichspb\messagebird;

use dimichspb\messagebird\adapters\MessageBirdClientAdapter;
use MessageBird\Client;

abstract class BaseApplication
{
    protected $clientAdapter;

    public function __construct(MessageBirdClientAdapter $clientAdapter)
    {
        $this->clientAdapter = $clientAdapter;
    }

    public function run()
    {
        var_dump(static::class);
    }
}