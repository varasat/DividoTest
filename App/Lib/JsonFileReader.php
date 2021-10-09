<?php


    namespace App\Lib;


    use App\Lib\Interfaces\FileReader;

    class JsonFileReader implements FileReader
    {
        public function getContentsOfFile(string $path): string
        {
            return file_get_contents($path);
        }

        public function formatContentsOfFile(string $contents): array
        {
            return json_decode($contents,true);
        }
    }