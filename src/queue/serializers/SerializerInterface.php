<?php
namespace dimichspb\messagebird\queue\serializers;

interface SerializerInterface
{
    public function serialize(array $data);

    public function unserialize($data);
}