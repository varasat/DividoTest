<?php


    namespace App\Models\Interfaces;

    /**
     * Interface Configuration
     * @package App\Models\Interfaces
     */
    interface Configuration
    {
        /**
         * @param  array  $data
         * @return bool
         */
        public function writeData(array $data): bool;
    }