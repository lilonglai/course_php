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
            $o = self::generateObject($o);
            $operator = new TeacherDefaultHolidayBusinessOperation();
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

    public static function deleteByTeacherId(Request $request, Response $response){
        try {
            $key = $request->getParam('id');
            $operator = new TeacherDefaultHolidayBusinessOperation();
            $operator->deleteByTeacherId($key);
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
        $o->week1 = false;
        $o->week2 = false;
        $o->week3 = false;
        $o->week4 = false;
        $o->week5 = false;
        $o->week6 = false;
        $o->week7 = false;

        if(isset($original['weeks'])){
            foreach ($original['weeks'] as $week){
                if($week == 'week1'){
                    $o->week1 = true;
                }
                else if($week == 'week2'){
                    $o->week2 = true;
                }
                else if($week == 'week3'){
                    $o->week3 = true;
                }
                else if($week == 'week4'){
                    $o->week4 = true;
                }
                else if($week == 'week5'){
                    $o->week5 = true;
                }
                else if($week == 'week6'){
                    $o->week6 = true;
                }
                else if($week == 'week7'){
                    $o->week7 = true;
                }
            }
        }
        return $o;
    }
}