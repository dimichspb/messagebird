<?php
namespace dimichspb\messagebird\queue\serializers;

class NativeSerializer implements SerializerInterface
{
    public function serialize(array $data)
    {
        return serialize($data);
    }

    public function unserialize($data)
    {
        $result = unserialize($data);

        return $result? $result: [];
    }



}