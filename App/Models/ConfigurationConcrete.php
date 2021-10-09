<?php


    namespace App\Models;

    use App\Models\Interfaces\Configuration;

    class ConfigurationConcrete implements Configuration
    {
        private string $data;
        public function __construct(string $data)
        {
            $this->data = $data;
        }

        public function readData(): string
        {
            return $this->data;
        }

        public function writeData(): bool
        {
            // TODO: Implement writeData() method.
        }
    }