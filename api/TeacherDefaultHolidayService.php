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
require "../bussiness/TeacherDefaultHolidayBusinessOperation.php";

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
        $o = array();
        $o[teacherid] = $request->getParam('teacherid');
        $o[week1] = $request->getParam('week1');
        $o[week2] = $request->getParam('week2');
        $o[week3] = $request->getParam('week3');
        $o[week4] = $request->getParam('week4');
        $o[week5] = $request->getParam('week5');
        $o[week6] = $request->getParam('week6');
        $o[week7] = $request->getParam('week7');

        $operator = new TeacherDefaultHolidayBusinessOperation();
        $operator->add($o);
    }

    public static function update(Request $request, Response $response)
    {
        $o = array();
        $o[id] = $request->getParam('id');
        $o[teacherid] = $request->getParam('teacherid');
        $o[week1] = $request->getParam('week1');
        $o[week2] = $request->getParam('week2');
        $o[week3] = $request->getParam('week3');
        $o[week4] = $request->getParam('week4');
        $o[week5] = $request->getParam('week5');
        $o[week6] = $request->getParam('week6');
        $o[week7] = $request->getParam('week7');

        $operator = new TeacherDefaultHolidayBusinessOperation();
        $operator->update($o);
    }

    public static function delete(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new TeacherDefaultHolidayBusinessOperation();
        $operator->delete($key);
    }
}