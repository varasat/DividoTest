<?php


    namespace App\Models;


    use App\Models\Interfaces\Configuration;

    class ConfigurationDecoratorBase implements Configuration
    {
        /**
         * @var Configuration
         */
        protected Configuration $component;
        protected array $dataset;

        public function __construct(Configuration $component,array $dataset)
        {
            $this->component = $component;
            $this->dataset = $dataset;
        }

        public function writeData(array $data): bool
        {
            return $this->component->writeData($data);
        }
    }