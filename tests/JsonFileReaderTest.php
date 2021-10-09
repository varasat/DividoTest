<?php


    use App\Lib\JsonFileReader;
    use PHPUnit\Framework\TestCase;

    class JsonFileReaderTest extends TestCase
    {
        private JsonFileReader $fileReader;

        protected function setUp(): void
        {
            $this->fileReader = new JsonFileReader();
        }

        public function testCanBeCreated()
        {
            $this->assertInstanceOf(
                JsonFileReader::class,
                new JsonFileReader()
            );
        }

        public function testGetContentsReturnsActualContentsOfFile()
        {
            $path = './App/Resources/TestFixtures/configtest.json';
            $this->assertEquals(
                '{"environment": "production"}',
                $this->fileReader->getContentsOfFile($path)
            );
        }

        public function testDecodedContentsAreAppropriate()
        {
            $content = '{"environment": "production"}';
            $this->assertEquals(
                ['environment' => 'production'],
                $this->fileReader->formatContentsOfFile($content)
            );
        }
    }