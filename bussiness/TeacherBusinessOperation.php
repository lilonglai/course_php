<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 15:06
 */
require __DIR__ ."/../db/PDOTeacherOperation.php";

class TeacherBusinessOperation
{
    public function get($key){
        $operator = new PDOTeacherOperation();
        $o = $operator->get($key);
        return $o;
    }

    public function getAll(){
        $operator = new PDOTeacherOperation();
        $list = $operator->getAll();
        return $list;
    }

    public function getAlive(){
        $operator = new PDOTeacherOperation();
        $list = $operator->getAlive();
        return $list;
    }

    public function getNotAlive(){
        $operator = new PDOTeacherOperation();
        $list = $operator->getNotAlive();
        return $list;
    }

    public function add($o){
        $operator = new PDOTeacherOperation();
        $operator->add($o);
    }

    public function update($o){
        $operator = new PDOTeacherOperation();
        $operator->update($o);
    }

    public function retire($key){
        $operator = new PDOTeacherOperation();
        $operator->retire($key);
    }

    public function delete($key){
        $operator = new PDOTeacherOperation();
        $operator->delete($key);
    }
}