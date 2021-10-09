<?php


    use App\Exceptions\FileDoesNotExistException;
    use App\Exceptions\JsonIsNotValidException;
    use App\Lib\JsonFileValidator;
    use PHPUnit\Framework\TestCase;

    class JsonFileValidatorTest extends TestCase
    {
        private JsonFileValidator $fileValidator;

        protected function setUp(): void
        {
            $this->fileValidator = new JsonFileValidator();
        }

        public function testCanBeCreated()
        {
            $this->assertInstanceOf(
                JsonFileValidator::class,
                new JsonFileValidator()
            );
        }

        public function testValidatorThrowsFileDoesNotExistException()
        {
            $path = './blabla.json';
            $this->expectException(FileDoesNotExistException::class);
            $this->fileValidator->validateFile($path);
        }

        public function testValidatorThrowsJsonIsNotValidExceptionException()
        {
            $contents = 'blabla this is not json/.sl';
            $this->expectException(JsonIsNotValidException::class);
            $this->fileValidator->validateFileContent($contents);
        }

        public function testValidatorDoesntThrowFileDoesNotExistException()
        {
            $path = './App/Resources/TestFixtures/config.json';
            $this->fileValidator->validateFile($path);
            $this->assertEquals(true, $this->fileValidator->validateFile($path));
        }

        public function testValidatorDoesntThrowJsonIsNotValidExceptionException()
        {
            $contents = '{
                "environment": "production",
                "database": {
                    "host": "mysql",
                    "port": 3306,
                    "username": "divido",
                    "password": "divido"
                  },
                "cache": {
                    "redis": {
                      "host": "redis",
                      "port": 6379
                    }
              }
            }';
            $this->assertEquals(true, $this->fileValidator->validateFileContent($contents));
        }
    }