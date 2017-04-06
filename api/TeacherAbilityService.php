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
require "../bussiness/TeacherAbilityBusinessOperation.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

class TeacherAbilityService
{
    public static function get(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new TeacherAbilityBusinessOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    public static function getAll(Request $request, Response $response)
    {
        $operator = new TeacherAbilityBusinessOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    public static function add(Request $request, Response $response)
    {
        $o = array();
        $o[teacherid] = $request->getParam('teacherid');
        $o[courseid] = $request->getParam('courseid');

        $operator = new TeacherAbilityBusinessOperation();
        $operator->add($o);
    }

    public static function update(Request $request, Response $response)
    {
        $o = array();
        $o[id] = $request->getParam('id');
        $o[teacherid] = $request->getParam('teacherid');
        $o[courseid] = $request->getParam('courseid');

        $operator = new TeacherAbilityBusinessOperation();
        $operator->update($o);
    }

    public static function delete(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new TeacherAbilityBusinessOperation();
        $operator->delete($key);
    }
}