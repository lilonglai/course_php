<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:13
 */
/*
 * begin to operate TeacherHoliday
 */
require __DIR__ . "/../bussiness/ScheduleBusinessOperation.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

class ScheduleService
{
    public static function get(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new ScheduleBusinessOperation();
        $result = $operator->get($key);
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function getAll(Request $request, Response $response)
    {
        $operator = new ScheduleBusinessOperation();
        $list = $operator->getAll();
        $newResponse = $response->withJson($list);
        return $newResponse;
    }

    public static function getAvailableSecondCourseList(Request $request, Response $response)
    {
        $studentId = $request->getParam('studentId');
        $firstCourseId = $request->getParam('firstCourseId');
        $operator = new ScheduleBusinessOperation();
        $result = $operator->getAvailableSecondCourseList($studentId, $firstCourseId);
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function getAvailableTeacherListByAbility(Request $request, Response $response)
    {
        $onDate = $request->getParam('onDate');
        $onTime = $request->getParam('onTime');
        $firstCourseId = $request->getParam('firstCourseId');
        $operator = new ScheduleBusinessOperation();
        $result = $operator->getAvailableTeacherListByAbility($onDate, $onTime, $firstCourseId);
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function getAvailableTeacherList(Request $request, Response $response)
    {
        $onDate = $request->getParam('onDate');
        $onTime = $request->getParam('onTime');
        $operator = new ScheduleBusinessOperation();
        $result = $operator->getAvailableTeacherList($onDate, $onTime);
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function getSecondCourseAndTeacherList(Request $request, Response $response)
    {
        $onDate = $request->getParam('onDate');
        $onTime = $request->getParam('onTime');
        $studentId = $request->getParam('studentId');
        $firstCourseId = $request->getParam('firstCourseId');
        $operator = new ScheduleBusinessOperation();
        $result = $operator->getSecondCourseAndTeacherList($onDate, $onTime, $studentId, $firstCourseId);
        $newResponse = $response->withJson($result);
        return $newResponse;
    }

    public static function add(Request $request, Response $response)
    {
        try {
            $o = $parsedBody = $request->getParsedBody();
            $o = self::generateObject($o);
            $operator = new ScheduleBusinessOperation();
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
            $operator = new ScheduleBusinessOperation();
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
            $operator = new ScheduleBusinessOperation();
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
        $o->id = (int)$original['id'];
        $o->onDate = $original['onDate'];
        $o->onTime = (int)$original['onTime'];
        $o->studentId = (int)$original['studentId'];
        $o->courseId = (int)$original['courseId'];
        $o->teacherId = (int)$original['teacherId'];
        $o->addition = $original['addition'];
        $o->description = $original['description'];
        return $o;
    }
}