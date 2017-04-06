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

class StudentService{
    static function get(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOStudentOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    static function getAll(Request $request, Response $response){
        $operator = new PDOStudentOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    static function getAlive(){
        $operator = new PDOStudentOperation();
        $list = $operator->getAlive();
        $result = json_encode($list);
        echo $result;
    }

    static function getNotAlive(){
        $operator = new PDOStudentOperation();
        $list = $operator->getNotAlive();
        $result = json_encode($list);
        echo $result;
    }

    static function add(Request $request, Response $response){
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

        $operator = new PDOStudentOperation();
        $operator->add($o);
    }

    static function update(Request $request, Response $response){
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

        $operator = new PDOStudentOperation();
        $operator->update($o);
    }

    static function retire(Request $request, Response $response){
        $key = $request->getParam('id');

        $operator = new PDOStudentOperation();
        $operator->retire($key);
    }

    static function delete(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOStudentOperation();
        $operator->delete($key);
    }
}