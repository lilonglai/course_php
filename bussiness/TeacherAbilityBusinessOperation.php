<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:06
 */
require __DIR__ ."/../db/PDOTeacherAbilityOperation.php";

class TeacherAbilityBusinessOperation
{
    public function get($key){
        $operator = new PDOTeacherAbilityOperation();
        $o = $operator->get($key);
        return $o;
    }

    public function getAll(){
        $operator = new PDOTeacherAbilityOperation();
        $list = $operator->getAll();
        return $list;
    }

    public function getByTeacherId($teacherId){
        $operator = new PDOTeacherAbilityOperation();
        $list = $operator->getByTeacherId($teacherId);
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