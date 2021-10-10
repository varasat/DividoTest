<?php


    namespace App\Lib;


    use App\Lib\Interfaces\FileReader;
    use App\Lib\Interfaces\FileValidator;
    use App\Lib\Interfaces\FileWriter;
    use App\Models\ConfigurationConcrete;
    use App\Models\ConfigurationDecoratorCache;
    use App\Models\ConfigurationDecoratorDatabase;
    use App\Models\ConfigurationDecoratorEnvironment;

    /**
     * Class JsonFileWriter
     * @package App\Lib
     */
    class JsonFileWriter implements FileWriter
    {
        /**
         * @var FileValidator
         */
        private FileValidator $fileValidator;
        /**
         * @var FileReader
         */
        private FileReader $fileReader;

        /**
         * JsonFileWriter constructor.
         * @param  FileValidator  $fileValidator
         * @param  FileReader  $fileReader
         */
        public function __construct(FileValidator $fileValidator, FileReader $fileReader)
        {
            $this->fileValidator = $fileValidator;
            $this->fileReader = $fileReader;
        }

        /**
         * @param  array  $files
         * @return bool
         */
        public function writeConfigFile(array $files): bool
        {
            if (empty($files)) {
                return true;
            }
            //let's go through all the config files to be loaded from last one to the first one since we're using a Decorator pattern
            $files = array_reverse($files);

            //adding the original config file in case all the config files only partially fill in some sections of the confing eg only the cache or the db
            $files[] = ConfigurationConcrete::CONFIG_FILE_PATH;
            $baseConfig = new ConfigurationConcrete();
            $filesWithErrors = 0;
            foreach ($files as $filepath) {
                //let's validate if all the files are valid
                try {
                    $this->fileValidator->validateFile($filepath);
                } catch (\Exception $exception) {
                    $filesWithErrors++;
                    continue; //if file isn't valid let's just skip decorating it
                }
                $fileContent = $this->fileReader->getContentsOfFile($filepath);

                try {
                    $this->fileValidator->validateFileContent($fileContent);
                } catch (\Exception $exception) {
                    $filesWithErrors++;
                    continue; //if file isn't valid let's just skip decorating it
                }

                // let's format everything into an array and start setting up the decorator
                $fileContentsArray = $this->fileReader->formatContentsOfFile($fileContent);
                //1 decorator per configuration section
                if (isset($fileContentsArray['cache'])) {
                    $baseConfig = new ConfigurationDecoratorCache($baseConfig, $fileContentsArray['cache']);
                }
                if (isset($fileContentsArray['database'])) {
                    $baseConfig = new ConfigurationDecoratorDatabase($baseConfig, $fileContentsArray['database']);
                }
                if (isset($fileContentsArray['environment'])) {
                    $baseConfig = new ConfigurationDecoratorEnvironment($baseConfig, $fileContentsArray);
                }
            }
            //Why change anything if nothing actually changed
            if (sizeof($files) == $filesWithErrors) {
                return true;
            }
            return $baseConfig->writeData([]);
        }
    }