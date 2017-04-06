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
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    public static function getAll(Request $request, Response $response)
    {
        $operator = new ScheduleBusinessOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    public static function getAvailableSecondCourseList(Request $request, Response $response)
    {
        $studentId = $request->getParam('studentId');
        $firstCourseId = $request->getParam('firstCourseId');
        $operator = new ScheduleBusinessOperation();
        $resultList = $operator->getAvailableSecondCourseList($studentId, $firstCourseId);
        $result = json_encode($resultList);
        echo $result;
    }

    public static function getAvailableTeacherListByAbility(Request $request, Response $response)
    {
        $onDate = $request->getParam('onDate');
        $onTime = $request->getParam('onTime');
        $firstCourseId = $request->getParam('firstCourseId');
        $operator = new ScheduleBusinessOperation();
        $resultList = $operator->getAvailableTeacherListByAbility($onDate, $onTime, $firstCourseId);
        $result = json_encode($resultList);
        echo $result;
    }

    public static function getAvailableTeacherList(Request $request, Response $response)
    {
        $onDate = $request->getParam('onDate');
        $onTime = $request->getParam('onTime');
        $operator = new ScheduleBusinessOperation();
        $resultList = $operator->getAvailableTeacherList($onDate, $onTime);
        $result = json_encode($resultList);
        echo $result;
    }

    public static function getSecondCourseAndTeacherList(Request $request, Response $response)
    {
        $onDate = $request->getParam('onDate');
        $onTime = $request->getParam('onTime');
        $studentId = $request->getParam('studentId');
        $firstCourseId = $request->getParam('firstCourseId');
        $operator = new ScheduleBusinessOperation();
        $resultList = $operator->getSecondCourseAndTeacherList($onDate, $onTime, $studentId, $firstCourseId);
        $result = json_encode($resultList);
        echo $result;
    }

    public static function add(Request $request, Response $response)
    {
        $o = array();
        $o[ondate] = $request->getParam('ondate');
        $o[ontime] = $request->getParam('ontime');
        $o[studentid] = $request->getParam('studentid');
        $o[courseid] = $request->getParam('courseid');
        $o[teacherid] = $request->getParam('teacherid');
        $o[addition] = $request->getParam('addition');
        $o[description] = $request->getParam('description');

        $operator = new ScheduleBusinessOperation();
        $operator->add($o);
    }

    public static function update(Request $request, Response $response)
    {
        $o = array();
        $o[id] = $request->getParam('id');
        $o[ondate] = $request->getParam('ondate');
        $o[ontime] = $request->getParam('ontime');
        $o[studentid] = $request->getParam('studentid');
        $o[courseid] = $request->getParam('courseid');
        $o[teacherid] = $request->getParam('teacherid');
        $o[addition] = $request->getParam('addition');
        $o[description] = $request->getParam('description');

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