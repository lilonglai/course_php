<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:10
 */
/*
 * begin to operate Teacher
 */
use \Slim\Http\Request;
use \Slim\Http\Response;

class TeacherService
{
    public static function get(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new TeacherBusinessOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    public static function getAll(Request $request, Response $response)
    {
        $operator = new TeacherBusinessOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    public static function getAlive()
    {
        $operator = new TeacherBusinessOperation();
        $list = $operator->getAlive();
        $result = json_encode($list);
        echo $result;
    }

    public static function getNotAlive()
    {
        $operator = new TeacherBusinessOperation();
        $list = $operator->getNotAlive();
        $result = json_encode($list);
        echo $result;
    }

    public static function add(Request $request, Response $response)
    {
        $o = array();
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[phone] = $request->getParam('phone');
        $o[ismaster] = $request->getParam('ismaster');

        $operator = new PDOTeacherOperation();
        $operator->add($o);
    }

    public static function update(Request $request, Response $response)
    {
        $o = array();
        $o[id] = $request->getParam('id');
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[phone] = $request->getParam('phone');
        $o[ismaster] = $request->getParam('ismaster');

        $operator = new TeacherBusinessOperation();
        $operator->update($o);
    }

    public static function retire(Request $request, Response $response)
    {
        $key = $request->getParam('id');

        $operator = new TeacherBusinessOperation();
        $operator->retire($key);
    }

    public static function delete(Request $request, Response $response)
    {
        $key = $request->getParam('id');
        $operator = new TeacherBusinessOperation();
        $operator->delete($key);
    }
}