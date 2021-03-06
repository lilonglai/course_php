<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:10
 */
/*
 * begin to operate Teacher
 */
require __DIR__ . "/../bussiness/TeacherBusinessOperation.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

class TeacherService
{
    public static function get(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new TeacherBusinessOperation();
        $result = $operator->get($key);
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function getAll(Request $request, Response $response)
    {
        $operator = new TeacherBusinessOperation();
        $result = $operator->getAll();
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function getAlive(Request $request, Response $response)
    {
        $operator = new TeacherBusinessOperation();
        $result = $operator->getAlive();
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function getNotAlive(Request $request, Response $response)
    {
        $operator = new TeacherBusinessOperation();
        $result = $operator->getNotAlive();
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function add(Request $request, Response $response)
    {
        try {
            $o = $parsedBody = $request->getParsedBody();
            $o = self::generateObject($o);
            $operator = new PDOTeacherOperation();
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
            $operator = new TeacherBusinessOperation();
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
            $operator = new TeacherBusinessOperation();
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
            $operator = new TeacherBusinessOperation();
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
        $o->phone = $original['phone'];

        if(isset($original['isMaster']) && $original['isMaster'] == 'on') {
            $o->isMaster = true;
        }
        else{
            $o->isMaster = false;
        }
        return $o;
    }
}