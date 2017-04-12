<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:08
 */
/*
 *  begin to operate FirstCourse
 */
require __DIR__ ."/../bussiness/FirstCourseBusinessOperation.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

class FirstCourseService
{
    public static function get(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new FirstCourseBusinessOperation();
        $result = $operator->get($key);
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function getByGrade(Request $request, Response $response)
    {
        $grade = $request->getParam('grade');
        $operator = new FirstCourseBusinessOperation();
        $result = $operator->getByGrade($grade);
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function getAll(Request $request, Response $response)
    {
        $operator = new FirstCourseBusinessOperation();
        $list = $operator->getAll();
        $newResponse = $response->withJson($list);
        return $newResponse;
    }

    public static function add(Request $request, Response $response)
    {
        $o = $parsedBody = $request->getParsedBody();
        $operator = new FirstCourseBusinessOperation();
        $operator->add($o);
    }

    public static function update(Request $request, Response $response)
    {
        $o = $parsedBody = $request->getParsedBody();
        $operator = new FirstCourseBusinessOperation();
        $operator->update($o);
    }

    public static function delete(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new FirstCourseBusinessOperation();
        $operator->delete($key);
    }
}