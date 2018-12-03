<?php

require_once __DIR__ . '/KeyValueStoreInterface.php';

/**
 * Class AbstractStorage
 */
abstract class AbstractStorage implements KeyValueStoreInterface

{
    protected $storage = [];

    protected $storageFile;


    /**
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value)
    {
        $this->storage[$key] = $value;
    }

    /**
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if($this->has($key)){
            return $this->storage[$key];
        }else{
            return $default;
        }
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has($key): bool
    {
        if (array_key_exists($key, $this->storage)) {
            return true;
        } else {
            return false;
        }
    }

    public function remove($key): void
    {
        unset($this->storage[$key]);
    }

    public function clear(): void
    {
        $this->storage = [];
    }
}