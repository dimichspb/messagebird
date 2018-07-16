<?php
namespace dimichspb\messagebird\queue;

use dimichspb\messagebird\Configurator;
use dimichspb\messagebird\entities\configuration\TimeOut;
use dimichspb\messagebird\helpers\AssertHelper;
use dimichspb\messagebird\queue\serializers\SerializerInterface;
use dimichspb\messagebird\queue\storages\StorageInterface;
use dimichspb\messagebird\queue\workers\WorkerInterface;

/**
 * Class Queue
 * @package dimichspb\messagebird\queue
 */
class Queue
{
    /**
     * @var TimeOut
     */
    protected $timeout;
    /**
     * @var mixed
     */
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
     * Queue constructor.
     * @param Configurator $configurator
     */
    public function __construct(Configurator $configurator)
    {
        $this->configurator = $configurator;

        $this->timeout = new TimeOut((int)$configurator->get('queue.timeout'));

        $storageClass = $configurator->get('queue.storage');
        $serializerClass = $configurator->get('queue.serializer');

        AssertHelper::isClassExist($storageClass);
        AssertHelper::isClassExist($serializerClass);

        $this->storage = $this->initStorage($storageClass);
        $this->serializer = $this->initSerializer($serializerClass);
    }

    /**
     * @param $storageClass
     * @return mixed
     */
    protected function initStorage($storageClass)
    {
        AssertHelper::isClassExist($storageClass);

        $storage = new $storageClass($this->configurator);

        AssertHelper::isInstanceOf($storage, StorageInterface::class);

        return $storage;
    }

    /**
     * @param $serializerClass
     * @return mixed
     */
    protected function initSerializer($serializerClass)
    {
        AssertHelper::isClassExist($serializerClass);

        $serializer = new $serializerClass;

        AssertHelper::isInstanceOf($serializer, SerializerInterface::class);

        return $serializer;
    }

    /**
     * @param SerializerInterface $serializer
     * @param StorageInterface $storage
     */
    protected function updateStorage(SerializerInterface $serializer, StorageInterface $storage)
    {

    }

    /**
     * @param SerializerInterface $serializer
     * @param StorageInterface $storage
     * @return mixed
     */
    protected function loadData(SerializerInterface $serializer, StorageInterface $storage)
    {
        $data = $serializer->unserialize($storage->getData());

        AssertHelper::isAllInstanceOf($data, WorkerInterface::class);

        return $data;
    }

    /**
     * @param SerializerInterface $serializer
     * @param StorageInterface $storage
     * @param array $data
     * @return mixed
     */
    protected function saveData(SerializerInterface $serializer, StorageInterface $storage, array $data)
    {
        AssertHelper::isAllInstanceOf($data, WorkerInterface::class);

        return $storage->saveData($serializer->serialize($data));
    }

    /**
     * @param WorkerInterface $worker
     * @return mixed
     */
    public function add(WorkerInterface $worker)
    {
        $data = $this->loadData($this->serializer, $this->storage);
        $data[] = $worker;
        return $this->saveData($this->serializer, $this->storage, $data);
    }

    /**
     * @return null
     */
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

    /**
     * @return int
     */
    public function count()
    {
        $data = $this->loadData($this->serializer, $this->storage);
        return count($data);
    }
}