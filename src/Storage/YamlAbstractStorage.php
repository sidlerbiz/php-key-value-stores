<?php
require_once __DIR__ . '/AbstractStorage.php';

class YamlAbstractStorage extends AbstractStorage
{
    public function __construct()
    {
        $this->storageFile = 'storage/yaml/storage.yml';

        $contentFromYmlFile = file_get_contents($this->storageFile);
        if ($contentFromYmlFile) {
            $this->storage = yaml_parse($contentFromYmlFile);
        } else {
            $this->clear();
        }
    }

    public function writeStorageIntoYamlFile($storage)
    {
        try {
            file_put_contents($this->storageFile, yaml_emit($storage));
        } catch (Exception $e) {
            echo 'Error with saving to yaml file: ', $e->getMessage(), "\n";
        }
    }

    public function set($key, $value)
    {
        parent::set($key, $value);

        $this->writeStorageIntoYamlFile($this->storage);
    }


}