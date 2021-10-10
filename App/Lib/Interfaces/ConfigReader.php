<?php


    namespace App\Lib\Interfaces;


    interface ConfigReader
    {
        public function readConfig(string $search): array;
    }