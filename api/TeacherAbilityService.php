<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:11
 */
/*
 * begin to operate TeacherAbility
 */
require __DIR__ . "/../bussiness/TeacherAbilityBusinessOperation.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

class TeacherAbilityService
{
    public static function get(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new TeacherAbilityBusinessOperation();
        $result = $operator->get($key);
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function getAll(Request $request, Response $response)
    {
        $operator = new TeacherAbilityBusinessOperation();
        $result = $operator->getAll();
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function add(Request $request, Response $response)
    {
        try {
            $o = $parsedBody = $request->getParsedBody();
            $o = self::generateObject($o);
            $operator = new TeacherAbilityBusinessOperation();
            $operator->add($o);
            $newResponse = $response->withJson($o);
            return $newResponse;
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
            $operator = new TeacherAbilityBusinessOperation();
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
            $operator = new TeacherAbilityBusinessOperation();
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
        $o->teacherId = (int)$original['teacherId'];
        $o->courseId = (int)$original['courseId'];
        return $o;
    }
}