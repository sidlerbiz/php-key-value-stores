<?php
require_once __DIR__ . '/KeyValueStoreInterface.php';
require_once __DIR__ . '/AbstractStorage.php';


class JsonAbstractStorage extends AbstractStorage
{
    public function __construct()
    {
        $this->storageFile = 'storage/json/storage.json';
        $contentFromJsonFile = file_get_contents($this->storageFile);
        if ($contentFromJsonFile) {
            $this->storage = json_decode($contentFromJsonFile, true);
        } else {
            $this->clear();
        }
    }

    protected function writeStorageIntoJsonFile($storage)
    {
        try{
            file_put_contents($this->storageFile, json_encode($storage));
        } catch(Exception $e) {
            return 'Error with saving to json file: '.  $e->getMessage(). "\n";
        }
    }

    public function set($key, $value)
    {
        parent::set($key, $value);

        $this->writeStorageIntoJsonFile($this->storage);
    }
}