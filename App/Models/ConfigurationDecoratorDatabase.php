<?php


    namespace App\Models;


    class ConfigurationDecoratorDatabase extends ConfigurationDecoratorBase
    {
        public function writeData(array $data): bool
        {
            $data['database'] = $this->dataset;
            return parent::writeData($data);
        }
    }