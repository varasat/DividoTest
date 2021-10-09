<?php


    namespace App\Models;

    use App\Models\Interfaces\Configuration;

    class ConfigurationConcrete implements Configuration
    {
        const CONFIG_FILE_PATH = './App/Resources/config.json';

        public function writeData(array $data): bool
        {
            $file = fopen(self::CONFIG_FILE_PATH, 'w');
            $newContents = json_encode($data);
            fwrite($file, $newContents);
            fclose($file);
            return true;
        }
    }