<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:06
 */
require "../db/PDOStudentOperation.php";

class StudentBusinessOperation
{
    public function get($key){
        $operator = new PDOStudentOperation();
        $o = $operator->get($key);
        return $o;
    }

    public function getAll(){
        $operator = new PDOStudentOperation();
        $list = $operator->getAll();
        return  $list;
    }

    public function getAlive(){
        $operator = new PDOStudentOperation();
        $list = $operator->getAlive();
        return $list;
    }

    public function getNotAlive(){
        $operator = new PDOStudentOperation();
        $list = $operator->getNotAlive();
        return $list;
    }

    public function add($o){
        $operator = new PDOStudentOperation();
        $operator->add($o);
    }

    public function update($o){
        $operator = new PDOStudentOperation();
        $operator->update($o);
    }

    public function retire($key){
        $operator = new PDOStudentOperation();
        $operator->retire($key);
    }

    public function delete($key){
        $operator = new PDOStudentOperation();
        $operator->delete($key);
    }
}