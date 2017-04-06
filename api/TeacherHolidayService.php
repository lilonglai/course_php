<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:12
 */
/*
 * begin to operate TeacherDefaultHoliday
 */
require "../bussiness/TeacherHolidayBusinessOperation.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

class TeacherHolidayService
{
    public static function get(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new TeacherHolidayBusinessOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    public static function getAll(Request $request, Response $response)
    {
        $operator = new TeacherHolidayBusinessOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    public static function add(Request $request, Response $response)
    {
        $o = array();
        $o[teacherid] = $request->getParam('teacherid');
        $o[adjustdate] = $request->getParam('adjustdate');
        $o[isholiday] = $request->getParam('isholiday');

        $operator = new TeacherHolidayBusinessOperation();
        $operator->add($o);
    }

    public static function update(Request $request, Response $response)
    {
        $o = array();
        $o[id] = $request->getParam('id');
        $o[teacherid] = $request->getParam('teacherid');
        $o[adjustdate] = $request->getParam('adjustdate');
        $o[isholiday] = $request->getParam('isholiday');

        $operator = new TeacherHolidayBusinessOperation();
        $operator->update($o);
    }

    public static function delete(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new TeacherHolidayBusinessOperation();
        $operator->delete($key);
    }
}
