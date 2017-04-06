<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:06
 */
require "../db/PDOTeacherDefaultHolidayOperation.php";

class TeacherDefaultHolidayBusinessOperation
{
    public function get($key){
        $operator = new PDOTeacherDefaultHolidayOperation();
        $o = $operator->get($key);
        return $o;
    }

    public function getAll(){
        $operator = new PDOTeacherDefaultHolidayOperation();
        $list = $operator->getAll();
        return $list;
    }

    public function add($o){
        $operator = new PDOTeacherDefaultHolidayOperation();
        $operator->add($o);
    }

    public function update($o){
        $operator = new PDOTeacherDefaultHolidayOperation();
        $operator->update($o);
    }

    public function delete($key){
        $operator = new PDOTeacherDefaultHolidayOperation();
        $operator->delete($key);
    }
}