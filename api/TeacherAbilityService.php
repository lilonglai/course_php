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
use \Slim\Http\Request;
use \Slim\Http\Response;

class TeacherAbilityService{
    static function get(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOTeacherAbilityOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    static function getAll(Request $request, Response $response){
        $operator = new PDOTeacherAbilityOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    static function add(Request $request, Response $response){
        $o = array();
        $o[teacherid] = $request->getParam('teacherid');
        $o[courseid] = $request->getParam('courseid');

        $operator = new PDOTeacherAbilityOperation();
        $operator->add($o);
    }

    static function update(Request $request, Response $response){
        $o = array();
        $o[id] = $request->getParam('id');
        $o[teacherid] = $request->getParam('teacherid');
        $o[courseid] = $request->getParam('courseid');

        $operator = new PDOTeacherAbilityOperation();
        $operator->update($o);
    }

    static function delete(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOTeacherAbilityOperation();
        $operator->delete($key);
    }
}