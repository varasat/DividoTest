<?php


    namespace App\Lib\Interfaces;


    interface FileValidator
    {
        public function validateFile($path);

        public function validateFileContent(string $fileContent): bool;
    }