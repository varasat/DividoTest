<?php


    namespace App\Controller;


    use App\Lib\Interfaces\FileReader;
    use App\Lib\JsonFileReader;
    use App\Lib\JsonFileValidator;
    use App\Models\ConfigurationConcrete;
    use App\Models\ConfigurationDecoratorBase;
    use App\Models\ConfigurationDecoratorCache;
    use App\Models\ConfigurationDecoratorDatabase;
    use App\Models\ConfigurationDecoratorEnvironment;
    use Exception;

    class FileParsingDemo
    {
        private JsonFileReader $fileReader;
        private JsonFileValidator $fileValidator;

        public function __construct(JsonFileReader $fileReader,
        JsonFileValidator $fileValidator)
        {
            $this->fileReader = $fileReader;
            $this->fileValidator = $fileValidator;
        }

        public function indexAction()
        {
//            var_dump(scandir('./App/Resources/TestFixtures/config.invalid.json'));
//            exit();
            $path = './App/Resources/TestFixtures/config.json';

            try {
                $this->fileValidator->validateFile($path);
            } catch (Exception $e){
                print_r($e->getMessage());
                return false;
            }

            $fileContents = $this->fileReader->getContentsOfFile($path);
            $fileContentsArray = $this->fileReader->formatContentsOfFile($fileContents);
            $baseConfig = new ConfigurationConcrete();

            if($fileContentsArray['cache']){
                $baseConfig = new ConfigurationDecoratorCache($baseConfig, $fileContentsArray['cache']);
            }
            if($fileContentsArray['database']){
                $baseConfig = new ConfigurationDecoratorDatabase($baseConfig, $fileContentsArray['database']);
            }
            if($fileContentsArray['environment']){
                $baseConfig = new ConfigurationDecoratorEnvironment($baseConfig, $fileContentsArray);
            }


//            $baseConfig =
            var_dump($baseConfig->writeData([]));
            exit();
            $cacheConfig = new ConfigurationDecoratorCache();
        }
    }