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
require "../bussiness/ScheduleBusinessOperation.php";

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
        $o = $parsedBody = $request->getParsedBody();
        $operator = new ScheduleBusinessOperation();
        $operator->add($o);
    }

    public static function update(Request $request, Response $response)
    {
        $o = $parsedBody = $request->getParsedBody();
        $operator = new ScheduleBusinessOperation();
        $operator->update($o);
    }

    public static function delete(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new ScheduleBusinessOperation();
        $operator->delete($key);
    }
}