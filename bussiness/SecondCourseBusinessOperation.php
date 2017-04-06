<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:05
 */
require "../db/PDOSecondCourseOperation.php";

class SecondCourseBusinessOperation
{
    public function get($key){
        $operator = new PDOSecondCourseOperation();
        $o = $operator->get($key);
        return $o;
    }

    public function getAll(){
        $operator = new PDOSecondCourseOperation();
        $list = $operator->getAll();
        return $list;
    }

    public function add($o){
        $operator = new PDOSecondCourseOperation();
        $operator->add($o);
    }

    public function update($o){
        $operator = new PDOSecondCourseOperation();
        $operator->update($o);
    }

    public function delete($key){
        $operator = new PDOSecondCourseOperation();
        $operator->delete($key);
    }
}