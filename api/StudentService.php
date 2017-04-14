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
        try {
            $o = $parsedBody = $request->getParsedBody();
            $o = self::generateObject($o);
            $operator = new StudentBusinessOperation();
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
            $o = self::generateObject($o);
            $operator = new StudentBusinessOperation();
            $operator->update($o);
        }
        catch(Exception $e){
            $newResponse = $response->withStatus(500, $e->getMessage());
            return $newResponse;
        }
    }

    public static function retire(Request $request, Response $response)
    {
        try {
            $key = $request->getParam('id');
            $operator = new StudentBusinessOperation();
            $operator->retire($key);
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
            $operator = new StudentBusinessOperation();
            $operator->delete($key);
        }
        catch(Exception $e){
            $newResponse = $response->withStatus(500, $e->getMessage());
            return $newResponse;
        }
    }

    public static function generateObject($original)
    {
        $o = new stdClass();
        if(isset($original['id'])) {
            $o->id = (int)$original['id'];
        }
        $o->name = $original['name'];
        $o->shortName = $original['shortName'];
        $o->grade = $original['grade'];
        $o->testScore = $original['testScore'];
        $o->targetScore = $original['targetScore'];
        $o->examineDate = $original['examineDate'];
        $o->examinePlace = $original['examinePlace'];
        $o->teacherId = (int)$original['teacherId'];
        $o->description = $original['description'];
        return $o;
    }
}