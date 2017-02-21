<?php
/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/2/20
 * Time: 11:56
 */


require "../vendor/autoload.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

$app = new \Slim\App();

$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    return $response->write("Hello, " . $args['name']);
});

$app->run();


