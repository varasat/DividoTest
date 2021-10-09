<?php


    namespace App\Models;


    class ConfigurationDecoratorEnvironment extends ConfigurationDecoratorBase
    {
        public function writeData(array $data): bool
        {
            $data['environment'] = $this->dataset['environment'];
            return parent::writeData($data);
        }
    }