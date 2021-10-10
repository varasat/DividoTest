<?php


    namespace App\Lib;


    use App\Lib\Interfaces\FileReader;

    /**
     * Class JsonFileReader
     * @package App\Lib
     */
    class JsonFileReader implements FileReader
    {
        /**
         * @param  string  $path
         * @return string
         */
        public function getContentsOfFile(string $path): string
        {
            return file_get_contents($path);
        }

        /**
         * @param  string  $contents
         * @return array
         */
        public function formatContentsOfFile(string $contents): array
        {
            return json_decode($contents, true);
        }
    }