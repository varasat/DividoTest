<?php


    namespace App\Controller;


    use App\Lib\Interfaces\FileReader;
    use App\Lib\JsonFileReader;
    use App\Lib\JsonFileValidator;
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
            var_dump($fileContentsArray);
        }
    }