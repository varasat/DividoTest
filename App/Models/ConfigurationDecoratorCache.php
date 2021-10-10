<?php

    namespace App\Models;


    /**
     * Class ConfigurationDecoratorCache
     * @package App\Models
     */
    class ConfigurationDecoratorCache extends ConfigurationDecoratorBase
    {
        /**
         * @param  array  $data
         * @return bool
         */
        public function writeData(array $data): bool
        {
            $data['cache'] = $this->dataset;
            return parent::writeData($data);
        }
    }