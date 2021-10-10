<?php


    use App\Lib\JsonFileReader;
    use App\Models\ConfigurationConcrete;
    use PHPUnit\Framework\TestCase;

    class ConfigurationConcreteTest extends TestCase
    {
        private ConfigurationConcrete $config;
        private JsonFileReader $fileReader;

        protected function setUp(): void
        {
            $this->config = new ConfigurationConcrete();
            $this->fileReader = new JsonFileReader();
        }

        public function testCanBeCreated()
        {
            $this->assertInstanceOf(
                ConfigurationConcrete::class,
                new ConfigurationConcrete()
            );
        }

        public function testIfEmptyDataConfigReturnsToDefault()
        {
            $defaultConfigContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $this->config->writeData();
            $configContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);

            $this->assertEquals(
                $defaultConfigContents,
                $configContents
            );
            $this->config->writeData(json_decode($defaultConfigContents, true));
        }

        public function testIfOnlyEnvironmentResetsRest()
        {
            $defaultConfigContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $configContentsArray = json_decode(
                $this->fileReader->getContentsOfFile('./App/Resources/TestFixtures/config_only_environment.json'),
                true
            );
            $this->config->writeData($configContentsArray);
            $configContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $this->assertEquals(
                '{"environment":"development","database":{"host":"mysql","port":3306,"username":"divido","password":"divido"},"cache":{"redis":{"host":"redis","port":6379}}}',
                $configContents
            );
            $this->config->writeData(json_decode($defaultConfigContents, true));
        }

        public function testIfOnlyDatabaseResetsRest()
        {
            $defaultConfigContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $configContentsArray = json_decode(
                $this->fileReader->getContentsOfFile('./App/Resources/TestFixtures/config_only_database.json'),
                true
            );
            $this->config->writeData($configContentsArray);
            $configContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $this->assertEquals(
                '{"environment":"production","database":{"host":"oracle","port":3306,"username":"divido","password":"divido"},"cache":{"redis":{"host":"redis","port":6379}}}',
                $configContents
            );
            $this->config->writeData(json_decode($defaultConfigContents, true));
        }

        public function testIfOnlyCacheResetsRest()
        {
            $defaultConfigContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $configContentsArray = json_decode(
                $this->fileReader->getContentsOfFile('./App/Resources/TestFixtures/config_only_cache.json'),
                true
            );
            $this->config->writeData($configContentsArray);
            $configContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $this->assertEquals(
                '{"environment":"production","database":{"host":"mysql","port":3306,"username":"divido","password":"divido"},"cache":{"mongoDb":{"host":"mongoDb","port":6379}}}',
                $configContents
            );
            $this->config->writeData(json_decode($defaultConfigContents, true));
        }

        public function testIfEverythingChangesEverythingIsOverwritten()
        {
            $defaultConfigContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $configContentsArray = json_decode(
                $this->fileReader->getContentsOfFile('./App/Resources/TestFixtures/config.local.json'),
                true
            );
            $this->config->writeData($configContentsArray);
            $configContents = $this->fileReader->getContentsOfFile(ConfigurationConcrete::CONFIG_FILE_PATH);
            $this->assertEquals(
                '{"environment":"development","database":{"host":"127.0.0.1","port":3306,"username":"divido","password":"divido"},"cache":{"redis":{"host":"127.0.0.1","port":6379}}}',
                $configContents
            );
            $this->config->writeData(json_decode($defaultConfigContents, true));
        }
    }