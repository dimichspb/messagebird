<?php
namespace dimichspb\messagebird\adapters;

use Closure;
use dimichspb\messagebird\entities\configuration\AccessKey;
use MessageBird\Client;

class MessageBirdClientAdapter
{
    protected $inhibitor;
    protected $instance;

    protected $access_key;

    public function __construct()
    {
        $this->inhibitor = Closure::bind(
            function ($access_key = null) {
                return new Client(
                    $access_key? $access_key: $this->access_key
                );
            },
            $this,
            static::class
        );
    }

    public function getInstance()
    {
        if ($this->instance instanceof Client) {
            return $this->instance;
        }

        return $this->instance = call_user_func($this->inhibitor);
    }

    public function setAccessKey(AccessKey $accessKey)
    {
        $this->access_key = $accessKey;
    }
}