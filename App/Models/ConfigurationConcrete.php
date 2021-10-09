<?php


    namespace App\Models;

    use App\Models\Interfaces\Configuration;

    class ConfigurationConcrete implements Configuration
    {
        private array $data;
        public function __construct(array $data)
        {
            $this->data = $data;
        }

        public function readData(): array
        {
            return $this->data;
        }

        public function writeData(): bool
        {
            // TODO: Implement writeData() method.
        }
    }