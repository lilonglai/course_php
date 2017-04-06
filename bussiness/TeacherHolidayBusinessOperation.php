<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:07
 */
require "../db/PDOTeacherHolidayOperation.php";

class TeacherHolidayBusinessOperation
{
    public function get($key){
        $operator = new PDOTeacherHolidayOperation();
        $o = $operator->get($key);
        return $o;
    }

    public function getAll(){
        $operator = new PDOTeacherHolidayOperation();
        $list = $operator->getAll();
        return $list;
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