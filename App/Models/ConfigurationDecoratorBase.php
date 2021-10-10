<?php


    namespace App\Models;


    use App\Models\Interfaces\Configuration;

    /**
     * Class ConfigurationDecoratorBase
     * @package App\Models
     */
    class ConfigurationDecoratorBase implements Configuration
    {
        /**
         * @var Configuration
         */
        protected Configuration $component;
        /**
         * @var array
         */
        protected array $dataset;

        /**
         * ConfigurationDecoratorBase constructor.
         * @param  Configuration  $component
         * @param  array  $dataset
         */
        public function __construct(Configuration $component, array $dataset)
        {
            $this->component = $component;
            $this->dataset = $dataset;
        }

        /**
         * @param  array  $data
         * @return bool
         */
        public function writeData(array $data): bool
        {
            return $this->component->writeData($data);
        }
    }