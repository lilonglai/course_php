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

class TeacherService{
    static function get(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOTeacherOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    static function getAll(Request $request, Response $response){
        $operator = new PDOTeacherOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    static function getAlive(){
        $operator = new PDOTeacherOperation();
        $list = $operator->getAlive();
        $result = json_encode($list);
        echo $result;
    }

    static function getNotAlive(){
        $operator = new PDOTeacherOperation();
        $list = $operator->getNotAlive();
        $result = json_encode($list);
        echo $result;
    }

    static function add(Request $request, Response $response){
        $o = array();
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[phone] = $request->getParam('phone');
        $o[ismaster] = $request->getParam('ismaster');

        $operator = new PDOTeacherOperation();
        $operator->add($o);
    }

    static function update(Request $request, Response $response){
        $o = array();
        $o[id] = $request->getParam('id');
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[phone] = $request->getParam('phone');
        $o[ismaster] = $request->getParam('ismaster');

        $operator = new PDOTeacherOperation();
        $operator->update($o);
    }

    static function retire(Request $request, Response $response){
        $key = $request->getParam('id');

        $operator = new PDOTeacherOperation();
        $operator->retire($key);
    }

    static function delete(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOTeacherOperation();
        $operator->delete($key);
    }
}