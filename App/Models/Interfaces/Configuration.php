<?php


    namespace App\Models\Interfaces;

    interface Configuration
    {
        public function readData(): string;
        public function writeData(): bool;
    }