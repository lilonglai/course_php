<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:05
 */
require __DIR__ . "/../db/PDOFirstCourseOperation.php";

class FirstCourseBusinessOperation
{
    public function get($key){
        $operator = new PDOFirstCourseOperation();
        $o = $operator->get($key);
        return $o;
    }

    public function getByGrade($grade){
        $operator = new PDOFirstCourseOperation();
        $list = $operator->getByGrade($grade);
        return $list;
    }

    public function getAll(){
        $operator = new PDOFirstCourseOperation();
        $list = $operator->getAll();
        return $list;
    }

    public function add($o){
        $operator = new PDOFirstCourseOperation();
        $operator->add($o);
    }

    public function update($o){
        $operator = new PDOFirstCourseOperation();
        $operator->update($o);
    }

    public function delete($key){
        $operator = new PDOFirstCourseOperation();
        $operator->delete($key);
    }
}