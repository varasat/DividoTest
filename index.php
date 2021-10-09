<?php
require __DIR__ . '/vendor/autoload.php';

    use App\Controller\FileParsingDemo;
    use App\Controller\Home;
use App\Controller\Investing;
use App\Lib\App;
use App\Lib\InterestCalculator;
use App\Lib\InvestHelper;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;

Router::get('/', function () {
    (new FileParsingDemo())->indexAction();
});

//Router::get('/invest', function () {
//    (new Investing(new InterestCalculator(),new InvestHelper()))->investingAction();
//});



Router::get('/post/([0-9]*)', function (Request $req, Response $res) {
    $res->toJSON([
        'post' => ['id' => $req->getParams()[0]],
        'status' => 'ok'
    ]);
});

App::run();

use App\Lib\Logger;

Logger::enableSystemLogs();
$logger = Logger::getInstance();
$logger->info('Hello World');