<?php
namespace dimichspb\messagebird\queue;

use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\helpers\AssertHelper;
use dimichspb\messagebird\queue\serializers\SerializerInterface;
use dimichspb\messagebird\queue\storages\StorageInterface;
use dimichspb\messagebird\queue\workers\WorkerInterface;

class Queue
{
    protected $timeout;
    protected $storage;

    /**
     * @var Configurator
     */
    protected $configurator;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    public function __construct(Configurator $configurator)
    {
        $this->configurator = $configurator;

        $timeout = (int)$configurator->get('queue.timeout');

        $storageClass = $configurator->get('queue.storage');
        $serializerClass = $configurator->get('queue.serializer');

        AssertHelper::isInteger($timeout);

        AssertHelper::isClassExist($storageClass);
        AssertHelper::isClassExist($serializerClass);


        $serializer = new $serializerClass;

        AssertHelper::isInstanceOf($serializer, SerializerInterface::class);

        $this->timeout = $timeout;

        $this->storage = $this->initStorage($storageClass);
        $this->serializer = $this->initSerializer($serializerClass);
    }

    protected function initStorage($storageClass)
    {
        AssertHelper::isClassExist($storageClass);

        $storage = new $storageClass($this->configurator);

        AssertHelper::isInstanceOf($storage, StorageInterface::class);

        return $storage;
    }

    protected function initSerializer($serializerClass)
    {
        AssertHelper::isClassExist($serializerClass);

        $serializer = new $serializerClass;

        AssertHelper::isInstanceOf($serializer, SerializerInterface::class);

        return $serializer;
    }

    protected function updateStorage(SerializerInterface $serializer, StorageInterface $storage)
    {

    }

    protected function loadData(SerializerInterface $serializer, StorageInterface $storage)
    {
        $data = $serializer->unserialize($storage->getData());

        AssertHelper::isAllInstanceOf($data, WorkerInterface::class);

        return $data;
    }

    protected function saveData(SerializerInterface $serializer, StorageInterface $storage, array $data)
    {
        AssertHelper::isAllInstanceOf($data, WorkerInterface::class);

        return $storage->saveData($serializer->serialize($data));
    }

    public function add(WorkerInterface $worker)
    {
        $data = $this->loadData($this->serializer, $this->storage);
        $data[] = $worker;
        return $this->saveData($this->serializer, $this->storage, $data);
    }

    public function one()
    {
        $data = $this->loadData($this->serializer, $this->storage);

        if ($this->count() === 0) {
            return null;
        }
        $worker = array_shift($data);
        if (!$worker) {
            return null;
        }
        $result = $worker->run();
        $this->saveData($this->serializer, $this->storage, $data);
        return $result;
    }

    public function count()
    {
        $data = $this->loadData($this->serializer, $this->storage);
        return count($data);
    }
}