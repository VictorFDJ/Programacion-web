<?php
define("DATA_DIR", __DIR__ . "/datax");
if(!is_dir(DATA_DIR)){
    mkdir(DATA_DIR,0007, true);
}

class Dbx
{
    public static function list($collection)
    {
        $dataPath = DATA_DIR . "/{$collection}";
        if (!is_dir($dataPath)) {
            return [];
        }
        $files = scandir($dataPath);
        $data = [];

        foreach ($files as $file) {
            $filePath = $dataPath . '/' . $file;

            if (!is_file($filePath)) {
                continue; // Saltar si no es un archivo válido o no es JSON
            }

            $content = file_get_contents($filePath);
            $itemData = unserialize($content);

            if ($itemData) {
                $data[] = $itemData;
            }
        }

    }

    public static function get($collection, $id)
    {
        $dataPath = DATA_DIR . "/{$collection}/{$id}.dat";
        if (!file_exists($dataPath)) {
            return null; // or throw an exception
        }
        $content = file_get_contents($dataPath);
        return unserialize($content);
    }
    public static function save($collection, $item)
    {
        $dataPath = DATA_DIR . "/{$collection}";

        if (!is_dir($dataPath)) {
            mkdir($dataPath, 0777, true);
        }

        $fileName = uniqid();
        $filePath = $dataPath . '/' . $fileName . '.dat';

        file_put_contents($filePath, serialize($item));
    }





}