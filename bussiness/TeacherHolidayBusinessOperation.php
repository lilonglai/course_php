<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:07
 */
class TeacherHolidayBusinessOperation
{
    public function get($key){
        $operator = new PDOTeacherHolidayOperation();
        $o = $operator->get($key);
        echo $o;
    }

    public function getAll(){
        $operator = new PDOTeacherHolidayOperation();
        $list = $operator->getAll();
        echo $list;
    }

    public function add($o){
        $operator = new PDOTeacherHolidayOperation();
        $operator->add($o);
    }

    public function update($o){
        $operator = new PDOTeacherHolidayOperation();
        $operator->update($o);
    }

    public function delete($key){
        $operator = new PDOTeacherHolidayOperation();
        $operator->delete($key);
    }
}