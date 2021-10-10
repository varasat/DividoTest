<?php


    namespace App\Lib\Interfaces;


    /**
     * Interface FileWriter
     * @package App\Lib\Interfaces
     */
    interface FileWriter
    {
        /**
         * @param  array  $files
         * @return bool
         */
        public function writeConfigFile(array $files): bool;
    }