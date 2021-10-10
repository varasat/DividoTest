<?php


    namespace App\Lib\Interfaces;


    /**
     * Interface FileReader
     * @package App\Lib\Interfaces
     */
    interface FileReader
    {
        /**
         * @param  string  $path
         * @return string
         */
        public function getContentsOfFile(string $path): string;

        /**
         * @param  string  $contents
         * @return array
         */
        public function formatContentsOfFile(string $contents): array;
    }