<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:10
 */
/*
*  begin to operate Student
*/
require __DIR__ . "/../bussiness/StudentBusinessOperation.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

class StudentService
{
    public static function get(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new StudentBusinessOperation();
        $result = $operator->get($key);
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function getAll(Request $request, Response $response)
    {
        $operator = new StudentBusinessOperation();
        $result = $operator->getAll();
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function getAlive(Request $request, Response $response)
    {
        $operator = new StudentBusinessOperation();
        $result = $operator->getAlive();
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function getNotAlive(Request $request, Response $response)
    {
        $operator = new StudentBusinessOperation();
        $result = $operator->getNotAlive();
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function add(Request $request, Response $response)
    {
        $o = $parsedBody = $request->getParsedBody();
        $operator = new StudentBusinessOperation();
        $operator->add($o);
    }

    public static function update(Request $request, Response $response)
    {
        $o = $parsedBody = $request->getParsedBody();
        $operator = new StudentBusinessOperation();
        $operator->update($o);
    }

    public static function retire(Request $request, Response $response)
    {
        $key = $request->getParam('id');

        $operator = new StudentBusinessOperation();
        $operator->retire($key);
    }

    public static function delete(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new StudentBusinessOperation();
        $operator->delete($key);
    }
}