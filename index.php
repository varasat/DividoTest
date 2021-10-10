<?php

    require __DIR__.'/vendor/autoload.php';

    use App\Controller\FileParsingDemo;
    use App\Controller\Home;
    use App\Controller\Investing;
    use App\Lib\App;
    use App\Lib\InterestCalculator;
    use App\Lib\InvestHelper;
    use App\Lib\JsonConfigReader;
    use App\Lib\JsonFileReader;
    use App\Lib\JsonFileValidator;
    use App\Lib\JsonFileWriter;
    use App\Lib\Router;
    use App\Lib\Request;
    use App\Lib\Response;

    Router::get(
        '/',
        function () {
            (new FileParsingDemo(
                new JsonFileWriter(
                    new JsonFileValidator(),
                    new JsonFileReader()
                ),
                new JsonConfigReader(
                    new JsonFileReader()
                )
            ))->indexAction();
        }
    );

    App::run();

    use App\Lib\Logger;

    Logger::enableSystemLogs();
    $logger = Logger::getInstance();