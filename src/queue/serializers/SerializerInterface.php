<?php
namespace dimichspb\messagebird\queue\serializers;

/**
 * Interface SerializerInterface
 * @package dimichspb\messagebird\queue\serializers
 */
interface SerializerInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function serialize(array $data);

    /**
     * @param $data
     * @return mixed
     */
    public function unserialize($data);
}