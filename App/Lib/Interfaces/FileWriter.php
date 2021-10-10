<?php


    namespace App\Lib\Interfaces;


    interface FileWriter
    {
        public function writeConfigFile(array $files): bool;
    }