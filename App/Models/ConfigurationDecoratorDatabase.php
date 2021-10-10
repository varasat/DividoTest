<?php


    namespace App\Models;


    /**
     * Class ConfigurationDecoratorDatabase
     * @package App\Models
     */
    class ConfigurationDecoratorDatabase extends ConfigurationDecoratorBase
    {
        /**
         * @param  array  $data
         * @return bool
         */
        public function writeData(array $data): bool
        {
            $data['database'] = $this->dataset;
            return parent::writeData($data);
        }
    }