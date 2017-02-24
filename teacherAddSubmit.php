<?php
/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/2/24
 * Time: 18:52
 */
require "db.php";
$teacher = array();
$teacher['name'] = $_GET['name'];
$teacher['shortname'] =  $_GET['shortName'];
$teacher['phone'] =  $_GET['phone'];
if($_GET['isMaster'] != null){
    $teacher['ismaster'] =  true;
}
else{
    $teacher['ismaster'] =  false;
}

$teacherOperation = new PDOTeacherOperation();
$teacherOperation->add($teacher);

$teacherDefaultHoliday = array();
$teacherDefaultHoliday['teacherid'] = $teacher['id'];

$teacherDefaultHoliday['week1'] =false;
$teacherDefaultHoliday['week2'] =false;
$teacherDefaultHoliday['week3'] =false;
$teacherDefaultHoliday['week4'] =false;
$teacherDefaultHoliday['week5'] =false;
$teacherDefaultHoliday['week6'] =false;
$teacherDefaultHoliday['week7'] =false;


if($_GET['weeks'] != null){
    $weeks = $_GET['weeks'];
    foreach($weeks as $week){
        if($week =='week1'){
            $teacherDefaultHoliday['week1'] =true;
        }
        elseif ($week == 'week2'){
            $teacherDefaultHoliday['week2'] =true;
        }
        elseif ($week == 'week3'){
            $teacherDefaultHoliday['week2'] =true;
        }
        elseif ($week == 'week4'){
            $teacherDefaultHoliday['week2'] =true;
        }
        elseif ($week == 'week5'){
            $teacherDefaultHoliday['week2'] =true;
        }
        elseif ($week == 'week6'){
            $teacherDefaultHoliday['week2'] =true;
        }
        elseif ($week == 'week7'){
            $teacherDefaultHoliday['week2'] =true;
        }
        elseif ($week == 'week2'){
            $teacherDefaultHoliday['week2'] =true;
        }
    }
}

$teacherDefaultHolidayOperation = new PDOTeacherDefaultHolidayOperation();
$teacherDefaultHolidayOperation->add($teacherDefaultHoliday);
