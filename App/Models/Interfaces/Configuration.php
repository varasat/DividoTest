<?php


    namespace App\Models\Interfaces;

    interface Configuration
    {
        public function readData(): array;
        public function writeData(): bool;
    }