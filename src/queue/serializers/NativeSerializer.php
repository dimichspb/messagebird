<?php
namespace dimichspb\messagebird\queue\serializers;

/**
 * Class NativeSerializer
 * @package dimichspb\messagebird\queue\serializers
 */
class NativeSerializer implements SerializerInterface
{
    /**
     * @param array $data
     * @return string
     */
    public function serialize(array $data)
    {
        return serialize($data);
    }

    /**
     * @param $data
     * @return array|mixed
     */
    public function unserialize($data)
    {
        $result = unserialize($data);

        return $result? $result: [];
    }



}