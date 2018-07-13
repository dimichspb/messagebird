<?php
namespace dimichspb\messagebird\queue\serializers;

interface SerializerInterface
{
    public function serialize($data);

    public function unserialize($data);
}