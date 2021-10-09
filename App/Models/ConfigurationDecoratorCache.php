<?php

    namespace App\Models;


    class ConfigurationDecoratorCache extends ConfigurationDecoratorBase
    {
        public function writeData(array $data): bool
        {
            $data['cache'] = $this->dataset;
            return parent::writeData($data);
        }
    }