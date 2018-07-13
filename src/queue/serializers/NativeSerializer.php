<?php
namespace dimichspb\messagebird\queue\serializers;

class NativeSerializer implements SerializerInterface
{
    public function serialize($data)
    {
        return serialize($data);
    }

    public function unserialize($data)
    {
        return unserialize($data);
    }



}