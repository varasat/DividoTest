<?php


    namespace App\Models;

    use App\Models\Interfaces\Configuration;

    /**
     * Class ConfigurationConcrete
     * @package App\Models
     */
    class ConfigurationConcrete implements Configuration
    {
        const CONFIG_FILE_PATH = './App/Resources/config.json';
        const DEFAULT_ENVIRONMENT = 'production';
        const DEFAULT_DATABASE = [
            'host' => 'mysql',
            'port' => 3306,
            'username' => 'divido',
            'password' => 'divido'
        ];
        const DEFAULT_CACHE = [
            'redis' => [
                'host' => 'redis',
                'port' => 6379
            ]
        ];

        /**
         * @param  array  $data
         * @return bool
         */
        public function writeData(array $data = []): bool
        {
            /**
             * let's just put the data in the right order, this can be skipped if we just want to save some time
             * and resources but for this task I would like the config to be in the right order just for better readability
             **/
            $dataset = [
                'environment' => $data['environment'] ?? self::DEFAULT_ENVIRONMENT,
                'database' => $data['database'] ?? self::DEFAULT_DATABASE,
                'cache' => $data['cache'] ?? self::DEFAULT_CACHE,
            ];
            $file = fopen(self::CONFIG_FILE_PATH, 'w');
            $newContents = json_encode($dataset);
            fwrite($file, $newContents);
            fclose($file);
            return true;
        }
    }