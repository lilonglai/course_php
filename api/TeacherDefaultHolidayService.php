<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:12
 */
/*
 * begin to operate TeacherHoliday
 */
require __DIR__ . "/../bussiness/TeacherDefaultHolidayBusinessOperation.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

class TeacherDefaultHolidayService
{
    public static function get(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new TeacherDefaultHolidayBusinessOperation();
        $result = $operator->get($key);
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function getAll(Request $request, Response $response)
    {
        $operator = new TeacherDefaultHolidayBusinessOperation();
        $result = $operator->getAll();
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function add(Request $request, Response $response)
    {
        try {
            $o = $parsedBody = $request->getParsedBody();
            $operator = new TeacherDefaultHolidayBusinessOperation();
            $operator->add($o);
        }
        catch(Exception $e){
            $newResponse = $response->withStatus(500, $e->getMessage());
            return $newResponse;
        }
    }

    public static function update(Request $request, Response $response)
    {
        try {
            $o = $parsedBody = $request->getParsedBody();
            $operator = new TeacherDefaultHolidayBusinessOperation();
            $operator->update($o);
        }
        catch(Exception $e){
            $newResponse = $response->withStatus(500, $e->getMessage());
            return $newResponse;
        }
    }

    public static function delete(Request $request, Response $response)
    {
        try {
            $key = $request->getParam('id');
            $operator = new TeacherDefaultHolidayBusinessOperation();
            $operator->delete($key);
        }
        catch(Exception $e){
            $newResponse = $response->withStatus(500, $e->getMessage());
            return $newResponse;
        }
    }
}