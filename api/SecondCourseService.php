<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:09
 */
/*
*  begin to operate SecondCourse
*/
use \Slim\Http\Request;
use \Slim\Http\Response;

class SecondCourseService
{
    public static function get(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new SecondCourseBusinessOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    public static function getAll(Request $request, Response $response)
    {
        $operator = new SecondCourseBusinessOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    public static function add(Request $request, Response $response)
    {
        $o = array();
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[firstcourseid] = $request->getParam('firstcourseid');
        $o[description] = $request->getParam('description');

        $operator = new SecondCourseBusinessOperation();
        $operator->add($o);
    }

    public static function update(Request $request, Response $response)
    {
        $o = array();
        $o[id] = $request->getParam('id');
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[firstcourseid] = $request->getParam('firstcourseid');
        $o[description] = $request->getParam('description');

        $operator = new SecondCourseBusinessOperation();
        $operator->update($o);
    }

    public static function delete(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new SecondCourseBusinessOperation();
        $operator->delete($key);
    }
}
