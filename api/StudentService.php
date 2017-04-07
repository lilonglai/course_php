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
require "../bussiness/StudentBusinessOperation.php";

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
        $o = array();
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[grade] = $request->getParam('grade');
        $o[testscore] = $request->getParam('testscore');
        $o[targetscore] = $request->getParam('targetscore');
        $o[examinedate] = $request->getParam('examinedate');
        $o[examineplace] = $request->getParam('examineplace');
        $o[teacherid] = $request->getParam('teacherid');
        $o[description] = $request->getParam('description');

        $operator = new StudentBusinessOperation();
        $operator->add($o);
    }

    public static function update(Request $request, Response $response)
    {
        $o = array();
        $o[id] = $request->getParam('id');
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[grade] = $request->getParam('grade');
        $o[testscore] = $request->getParam('testscore');
        $o[targetscore] = $request->getParam('targetscore');
        $o[examinedate] = $request->getParam('examinedate');
        $o[examineplace] = $request->getParam('examineplace');
        $o[teacherid] = $request->getParam('teacherid');
        $o[description] = $request->getParam('description');

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