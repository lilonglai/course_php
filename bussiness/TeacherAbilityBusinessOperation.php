<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:06
 */
require "../db/PDOTeacherAbilityOperation.php";

class TeacherAbilityBusinessOperation
{
    public function get($key){
        $operator = new PDOTeacherAbilityOperation();
        $o = $operator->get($key);
        echo $o;
    }

    public function getAll(Request $request, Response $response){
        $operator = new PDOTeacherAbilityOperation();
        $list = $operator->getAll();
        return $list;
    }

    public function add($o){
        $operator = new PDOTeacherAbilityOperation();
        $operator->add($o);
    }

    public function update($o){
        $operator = new PDOTeacherAbilityOperation();
        $operator->update($o);
    }

    public function delete($key){
        $operator = new PDOTeacherAbilityOperation();
        $operator->delete($key);
    }
}