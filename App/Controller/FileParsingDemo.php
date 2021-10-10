<?php


    namespace App\Controller;


    use App\Lib\JsonConfigReader;
    use App\Lib\JsonFileWriter;

    class FileParsingDemo
    {
        private JsonFileWriter $fileWriter;
        private JsonConfigReader $configReader;

        public function __construct(
            JsonFileWriter $fileWriter,
            JsonConfigReader $configReader

        ) {
            $this->fileWriter = $fileWriter;
            $this->configReader = $configReader;
        }

        public function indexAction()
        {
            $path1 = './App/Resources/TestFixtures/config.json';
            $path2 = './App/Resources/TestFixtures/config_only_environment.json';
            $path3 = './App/Resources/TestFixtures/config_only_database.json';
            $path4 = './App/Resources/TestFixtures/config_only_cache.json';
            $path4 = './App/Resources/TestFixtures/config.invalid.json';
            $test = $this->fileWriter->writeConfigFile([$path1]);

            $testConfigContent = $this->configReader->readConfig('cache.redis.host');
        }
    }