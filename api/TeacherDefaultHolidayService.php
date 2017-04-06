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
use \Slim\Http\Request;
use \Slim\Http\Response;

class TeacherDefaultHolidayService{
    static function get(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOTeacherDefaultHolidayOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    static function getAll(Request $request, Response $response){
        $operator = new PDOTeacherDefaultHolidayOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    static function add(Request $request, Response $response){
        $o = array();
        $o[teacherid] = $request->getParam('teacherid');
        $o[week1] = $request->getParam('week1');
        $o[week2] = $request->getParam('week2');
        $o[week3] = $request->getParam('week3');
        $o[week4] = $request->getParam('week4');
        $o[week5] = $request->getParam('week5');
        $o[week6] = $request->getParam('week6');
        $o[week7] = $request->getParam('week7');

        $operator = new PDOTeacherDefaultHolidayOperation();
        $operator->add($o);
    }

    static function update(Request $request, Response $response){
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

        $operator = new PDOTeacherDefaultHolidayOperation();
        $operator->update($o);
    }

    static function delete(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOTeacherDefaultHolidayOperation();
        $operator->delete($key);
    }
}