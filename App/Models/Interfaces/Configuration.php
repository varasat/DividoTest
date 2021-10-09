<?php


    namespace App\Models\Interfaces;

    interface Configuration
    {
        public function writeData(array $data): bool;
    }