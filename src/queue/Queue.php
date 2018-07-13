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

    /**
     * @var WorkerInterface[]
     */
    protected $data = [];

    public function __construct(Configurator $configurator)
    {
        $this->configurator = $configurator;

        $timeout = $configurator->get('queue.timeout');

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

        $this->data = $this->loadData($serializer, $this->storage);
    }

    protected function initStorage($storageClass)
    {
        AssertHelper::isClassExist($storageClass);

        $storage = new $storageClass;

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

        $storage->saveData($serializer->serialize($data));
    }

    public function add(WorkerInterface $worker)
    {
        $this->data[] = $worker;
    }

    public function one()
    {
        $data = $this->data;
        $worker = array_shift($data);
        $worker->run();
        $this->data = $data;
        $this->saveData($this->serializer, $this->storage, $data);
    }

    public function all()
    {
        $data = $this->data;

        foreach ($data as $index => $worker) {
            $worker->run();
            unset($data[$index]);
        }
        $this->data = $data;
        $this->saveData($this->serializer, $this->storage, $data);
    }
}