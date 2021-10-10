<?php


    namespace App\Lib\Interfaces;


    /**
     * Interface ConfigReader
     * @package App\Lib\Interfaces
     */
    interface ConfigReader
    {
        /**
         * @param  string  $search
         * @return array
         */
        public function readConfig(string $search): array;
    }