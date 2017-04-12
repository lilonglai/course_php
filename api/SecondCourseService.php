<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:09
 */
/*
*  begin to operate SecondCourse
*/
require __DIR__ . "/../bussiness/SecondCourseBusinessOperation.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

class SecondCourseService
{
    public static function get(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new SecondCourseBusinessOperation();
        $result = $operator->get($key);
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function getByGrade(Request $request, Response $response)
    {
        $grade = $request->getParam('grade');
        $operator = new SecondCourseBusinessOperation();
        $result = $operator->getByGrade($grade);
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function getAll(Request $request, Response $response)
    {
        $operator = new SecondCourseBusinessOperation();
        $result = $operator->getAll();
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function add(Request $request, Response $response)
    {
        $o = $parsedBody = $request->getParsedBody();
        $operator = new SecondCourseBusinessOperation();
        $operator->add($o);
    }

    public static function update(Request $request, Response $response)
    {
        $o = $parsedBody = $request->getParsedBody();
        $operator = new SecondCourseBusinessOperation();
        $operator->update($o);
    }

    public static function delete(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new SecondCourseBusinessOperation();
        $operator->delete($key);
    }
}
