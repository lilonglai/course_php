<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:12
 */
/*
 * begin to operate TeacherDefaultHoliday
 */
use \Slim\Http\Request;
use \Slim\Http\Response;

class TeacherHolidayService{
    static function get(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOTeacherHolidayOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    static function getAll(Request $request, Response $response){
        $operator = new PDOTeacherHolidayOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    static function add(Request $request, Response $response){
        $o = array();
        $o[teacherid] = $request->getParam('teacherid');
        $o[adjustdate] = $request->getParam('adjustdate');
        $o[isholiday] = $request->getParam('isholiday');

        $operator = new PDOTeacherHolidayOperation();
        $operator->add($o);
    }

    static function update(Request $request, Response $response){
        $o = array();
        $o[id] = $request->getParam('id');
        $o[teacherid] = $request->getParam('teacherid');
        $o[adjustdate] = $request->getParam('adjustdate');
        $o[isholiday] = $request->getParam('isholiday');

        $operator = new PDOTeacherHolidayOperation();
        $operator->update($o);
    }

    static function delete(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOTeacherHolidayOperation();
        $operator->delete($key);
    }
}
