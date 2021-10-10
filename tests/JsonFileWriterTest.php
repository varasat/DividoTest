<?php


    use App\Lib\Interfaces\FileValidator;
    use App\Lib\JsonFileReader;
    use App\Lib\JsonFileValidator;
    use App\Lib\JsonFileWriter;
    use App\Models\ConfigurationConcrete;
    use PHPUnit\Framework\TestCase;

    class JsonFileWriterTest extends TestCase
    {
        private JsonFileWriter $fileWriter;
        private $fileValidator;
        private $fileReader;
        private ConfigurationConcrete $config;

        protected function setUp(): void
        {
            $this->fileValidator = $this->createMock(FileValidator::class);
            $this->fileReader = new JsonFileReader();
            $this->config = new ConfigurationConcrete();

            $this->fileWriter = new JsonFileWriter($this->fileValidator, $this->fileReader);
        }

        protected function setSpecialValidator()
        {
            /**
             * From my knowledge and having a look around there
             * doesn't seem to be any way of checking for exceptions based on certain arguments.
             */
            $this->fileValidator = new JsonFileValidator();
            $this->fileWriter = new JsonFileWriter($this->fileValidator, $this->fileReader);
        }

        protected function unsetSpecialValidator()
        {
            $this->fileValidator = $this->createMock(FileValidator::class);
            $this->fileWriter = new JsonFileWriter($this->fileValidator, $this->fileReader);
        }


        public function testCanBeCreated()
        {
            $this->assertInstanceOf(
                JsonFileWriter::class,
                new JsonFileWriter($this->fileValidator, $this->fileReader)
            );
        }

        public function testNoValidFilesNothingChanges()
        {
            $defaultConfigContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $this->fileValidator->method('validateFile')->withAnyParameters()->willThrowException(
                new Exception("bla")
            );
            $this->fileWriter->writeConfigFile(['bla1', 'bla2', 'bla3']);
            $configContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);

            $this->assertEquals(
                $defaultConfigContents,
                $configContents
            );
            $this->config->writeData(json_decode($defaultConfigContents, true));
        }

        public function testOneInvalidFileItIsntApplied()
        {
            $this->setSpecialValidator();
            $defaultConfigContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $path1 = './App/Resources/TestFixtures/config_only_environment.json';
            $path2 = './App/Resources/TestFixtures/config.invalid.jcon';

            $this->fileWriter->writeConfigFile([$path1, $path2]);
            $configContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $expectedArray = json_decode($defaultConfigContents, 1);
            $expectedArray['environment'] = 'development';

            $this->assertEquals(
                $expectedArray,
                json_decode($configContents, 1)
            );
            $this->config->writeData(json_decode($defaultConfigContents, true));
            $this->unsetSpecialValidator();
        }

        public function testFileWithEnvironmentIsApplied()
        {
            $defaultConfigContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $path1 = './App/Resources/TestFixtures/config_only_environment.json';

            $this->fileWriter->writeConfigFile([$path1]);
            $configContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $expectedArray = json_decode($defaultConfigContents, 1);
            $expectedArray['environment'] = 'development';

            $this->assertEquals(
                $expectedArray,
                json_decode($configContents, 1)
            );
            $this->config->writeData(json_decode($defaultConfigContents, true));
        }

        public function testFileWithDatabaseIsApplied()
        {
            $defaultConfigContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $path1 = './App/Resources/TestFixtures/config_only_database.json';

            $this->fileWriter->writeConfigFile([$path1]);
            $configContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $expectedArray = json_decode($defaultConfigContents, 1);
            $expectedArray['database'] = [
                'host' => 'oracle',
                'port' => 3306,
                'username' => 'divido',
                'password' => 'divido'
            ];

            $this->assertEquals(
                $expectedArray,
                json_decode($configContents, 1)
            );

            $this->config->writeData(json_decode($defaultConfigContents, true));
        }

        public function testFileWithCacheIsApplied()
        {
            $defaultConfigContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $path1 = './App/Resources/TestFixtures/config_only_cache.json';

            $this->fileWriter->writeConfigFile([$path1]);
            $configContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $expectedArray = json_decode($defaultConfigContents, 1);
            $expectedArray['cache'] = [
                'mongoDb' => [
                    'host' => 'mongoDb',
                    'port' => 6379
                ]
            ];

            $this->assertEquals(
                $expectedArray,
                json_decode($configContents, 1)
            );

            $this->config->writeData(json_decode($defaultConfigContents, true));
        }

        public function testMultipleFilesAreApplied()
        {
            $defaultConfigContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $path1 = './App/Resources/TestFixtures/config_only_environment.json';
            $path2 = './App/Resources/TestFixtures/config_only_database.json';
            $path3 = './App/Resources/TestFixtures/config_only_cache.json';

            $this->fileWriter->writeConfigFile([$path1, $path2, $path3]);
            $configContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $expectedArray = json_decode($defaultConfigContents, 1);
            $expectedArray['environment'] = 'development';
            $expectedArray['database'] = [
                'host' => 'oracle',
                'port' => 3306,
                'username' => 'divido',
                'password' => 'divido'
            ];
            $expectedArray['cache'] = [
                'mongoDb' => [
                    'host' => 'mongoDb',
                    'port' => 6379
                ]
            ];

            $this->assertEquals(
                $expectedArray,
                json_decode($configContents, 1)
            );

            $this->config->writeData(json_decode($defaultConfigContents, true));
        }

        public function testMultipleEnvironmentFilesLastOneIsApplied()
        {
            $defaultConfigContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $path1 = './App/Resources/TestFixtures/config_only_environment.json';
            $path2 = './App/Resources/TestFixtures/config_only_environment_staging.json';

            $this->fileWriter->writeConfigFile([$path1, $path2]);
            $configContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $expectedArray = json_decode($defaultConfigContents, 1);
            $expectedArray['environment'] = 'staging';

            $this->assertEquals(
                $expectedArray,
                json_decode($configContents, 1)
            );
            $this->config->writeData(json_decode($defaultConfigContents, true));
        }

    }