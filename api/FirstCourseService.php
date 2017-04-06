<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:08
 */
/*
 *  begin to operate FirstCourse
 */
use \Slim\Http\Request;
use \Slim\Http\Response;

class FirstCourseService
{
    public static function get(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new FirstCourseBusinessOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    public static function getAll(Request $request, Response $response)
    {
        $operator = new FirstCourseBusinessOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    public static function add(Request $request, Response $response)
    {
        $o = array();
        $o[grade] = $request->getParam('grade');
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[description] = $request->getParam('description');

        $operator = new FirstCourseBusinessOperation();
        $operator->add($o);
    }

    public static function update(Request $request, Response $response)
    {
        $o = array();
        $o[id] = $request->getParam('id');
        $o[grade] = $request->getParam('grade');
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[description] = $request->getParam('description');

        $operator = new FirstCourseBusinessOperation();
        $operator->update($o);
    }

    public static function delete(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new FirstCourseBusinessOperation();
        $operator->delete($key);
    }
}