<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:10
 */
/*
*  begin to operate Student
*/
use \Slim\Http\Request;
use \Slim\Http\Response;

class StudentService
{
    public static function get(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new StudentBusinessOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    public static function getAll(Request $request, Response $response)
    {
        $operator = new StudentBusinessOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    public static function getAlive()
    {
        $operator = new StudentBusinessOperation();
        $list = $operator->getAlive();
        $result = json_encode($list);
        echo $result;
    }

    public static function getNotAlive()
    {
        $operator = new StudentBusinessOperation();
        $list = $operator->getNotAlive();
        $result = json_encode($list);
        echo $result;
    }

    public static function add(Request $request, Response $response)
    {
        $o = array();
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[grade] = $request->getParam('grade');
        $o[testscore] = $request->getParam('testscore');
        $o[targetscore] = $request->getParam('targetscore');
        $o[examinedate] = $request->getParam('examinedate');
        $o[examineplace] = $request->getParam('examineplace');
        $o[teacherid] = $request->getParam('teacherid');
        $o[description] = $request->getParam('description');

        $operator = new StudentBusinessOperation();
        $operator->add($o);
    }

    public static function update(Request $request, Response $response)
    {
        $o = array();
        $o[id] = $request->getParam('id');
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[grade] = $request->getParam('grade');
        $o[testscore] = $request->getParam('testscore');
        $o[targetscore] = $request->getParam('targetscore');
        $o[examinedate] = $request->getParam('examinedate');
        $o[examineplace] = $request->getParam('examineplace');
        $o[teacherid] = $request->getParam('teacherid');
        $o[description] = $request->getParam('description');

        $operator = new StudentBusinessOperation();
        $operator->update($o);
    }

    public static function retire(Request $request, Response $response)
    {
        $key = $request->getParam('id');

        $operator = new StudentBusinessOperation();
        $operator->retire($key);
    }

    public static function delete(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new StudentBusinessOperation();
        $operator->delete($key);
    }
}