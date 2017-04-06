<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:05
 */
class FirstCourseBusinessOperation
{
    public function get($key){
        $operator = new PDOFirstCourseOperation();
        $o = $operator->get($key);
        echo $o;
    }

    public function getAll(){
        $operator = new PDOFirstCourseOperation();
        $list = $operator->getAll();
        echo $list;
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