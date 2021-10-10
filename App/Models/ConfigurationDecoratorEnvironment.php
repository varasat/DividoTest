<?php


    namespace App\Models;


    /**
     * Class ConfigurationDecoratorEnvironment
     * @package App\Models
     */
    class ConfigurationDecoratorEnvironment extends ConfigurationDecoratorBase
    {
        /**
         * @param  array  $data
         * @return bool
         */
        public function writeData(array $data): bool
        {
            $data['environment'] = $this->dataset['environment'];
            return parent::writeData($data);
        }
    }