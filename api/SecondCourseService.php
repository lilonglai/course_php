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

class SecondCourseService{
    static function get(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOSecondCourseOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    static function getAll(Request $request, Response $response){
        $operator = new PDOSecondCourseOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    static function add(Request $request, Response $response){
        $o = array();
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[firstcourseid] = $request->getParam('firstcourseid');
        $o[description] = $request->getParam('description');

        $operator = new PDOSecondCourseOperation();
        $operator->add($o);
    }

    static function update(Request $request, Response $response){
        $o = array();
        $o[id] = $request->getParam('id');
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[firstcourseid] = $request->getParam('firstcourseid');
        $o[description] = $request->getParam('description');

        $operator = new PDOSecondCourseOperation();
        $operator->update($o);
    }

    static function delete(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOSecondCourseOperation();
        $operator->delete($key);
    }
}
