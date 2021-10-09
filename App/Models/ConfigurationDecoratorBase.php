<?php


    namespace App\Models;


    use App\Models\Interfaces\Configuration;

    class ConfigurationDecoratorBase implements Configuration
    {
        /**
         * @var Configuration
         */
        protected Configuration $component;

        public function __construct(Configuration $component)
        {
            $this->component = $component;
        }


        public function readData(): string
        {
            $this->component->readData();
        }

        public function writeData(): bool
        {
            $this->component->writeData();
        }
    }