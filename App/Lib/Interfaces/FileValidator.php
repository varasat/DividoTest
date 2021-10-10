<?php


    namespace App\Lib\Interfaces;


    /**
     * Interface FileValidator
     * @package App\Lib\Interfaces
     */
    interface FileValidator
    {
        /**
         * @param $path
         * @return mixed
         */
        public function validateFile($path);

        /**
         * @param  string  $fileContent
         * @return bool
         */
        public function validateFileContent(string $fileContent): bool;
    }