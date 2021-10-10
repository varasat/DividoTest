<?php


    use App\Lib\Interfaces\FileReader;
    use App\Lib\JsonConfigReader;
    use PHPUnit\Framework\TestCase;

    class JsonConfigReaderTest extends TestCase
    {
        private $fileReader;
        private JsonConfigReader $configReader;

        protected function setUp(): void
        {
            $this->fileReader = $this->createMock(FileReader::class);
            $this->configReader = new JsonConfigReader($this->fileReader);
        }

        public function testCanBeCreated()
        {
            $this->assertInstanceOf(
                JsonConfigReader::class,
                new JsonConfigReader($this->fileReader)
            );
        }

        public function testGetAllContentWhenSearchTermsEmpty()
        {
            $configContent = '{"environment":"production","database":{"host":"mysql","port":3306,"username":"divido","password":"divido"},"cache":{"redis":{"host":"redis","port":6379}}}';
            $this->fileReader->method('getContentsOfFile')->withAnyParameters()->willReturn($configContent);
            $expectedArray = array(
                'environment' => 'production',
                'database' =>
                    array(
                        'host' => 'mysql',
                        'port' => 3306,
                        'username' => 'divido',
                        'password' => 'divido',
                    ),
                'cache' =>
                    array(
                        'redis' =>
                            array(
                                'host' => 'redis',
                                'port' => 6379,
                            ),
                    ),
            );
            $this->assertEquals(
                $expectedArray,
                $this->configReader->readConfig()
            );
        }

        public function testGetLevel1ContentString()
        {
            $configContent = '{"environment":"production","database":{"host":"mysql","port":3306,"username":"divido","password":"divido"},"cache":{"redis":{"host":"redis","port":6379}}}';
            $this->fileReader->method('getContentsOfFile')->withAnyParameters()->willReturn($configContent);
            $expectedArray = array(
                'environment' => 'production',
            );
            $this->assertEquals(
                $expectedArray,
                $this->configReader->readConfig('environment')
            );
        }

        public function testGetLevel1ContentArray()
        {
            $configContent = '{"environment":"production","database":{"host":"mysql","port":3306,"username":"divido","password":"divido"},"cache":{"redis":{"host":"redis","port":6379}}}';
            $this->fileReader->method('getContentsOfFile')->withAnyParameters()->willReturn($configContent);
            $expectedArray = array(
                'database' =>
                    array(
                        'host' => 'mysql',
                        'port' => 3306,
                        'username' => 'divido',
                        'password' => 'divido',
                    ),
            );
            $this->assertEquals(
                $expectedArray,
                $this->configReader->readConfig('database')
            );
        }

        public function testGetLevel2NestedContent()
        {
            $configContent = '{"environment":"production","database":{"host":"mysql","port":3306,"username":"divido","password":"divido"},"cache":{"redis":{"host":"redis","port":6379}}}';
            $this->fileReader->method('getContentsOfFile')->withAnyParameters()->willReturn($configContent);
            $expectedArray = array(
                'host' => 'mysql'
            );
            $this->assertEquals(
                $expectedArray,
                $this->configReader->readConfig('database.host')
            );
        }

        public function testGetLevel3NestedContent()
        {
            $configContent = '{"environment":"production","database":{"host":"mysql","port":3306,"username":"divido","password":"divido"},"cache":{"redis":{"host":"redis","port":6379}}}';
            $this->fileReader->method('getContentsOfFile')->withAnyParameters()->willReturn($configContent);
            $expectedArray = array(
                'host' => 'redis'
            );
            $this->assertEquals(
                $expectedArray,
                $this->configReader->readConfig('cache.redis.host')
            );
        }
    }