<?php
/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/2/20
 * Time: 11:56
 */


require "../vendor/autoload.php";
require "../db.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

$app = new \Slim\App();

$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    return $response->write("Hello, " . $args['name']);
});

$app->get('/firstcourse/get', 'FirstCourseService::get');
$app->get('/firstcourse/getall', 'FirstCourseService::getAll');
$app->get('/firstcourse/add', 'FirstCourseService::add');
$app->get('/firstcourse/update', 'FirstCourseService::update');
$app->get('/firstcourse/delete', 'FirstCourseService::delete');

$app->get('/secondcourse/get', 'SecondCourseService::get');
$app->get('/secondcourse/getall', 'SecondCourseService::getAll');
$app->get('/secondcourse/add', 'SecondCourseService::add');
$app->get('/secondcourse/update', 'SecondCourseService::update');
$app->get('/secondcourse/delete', 'SecondCourseService::delete');

$app->get('/student/get', 'StudentService::get');
$app->get('/student/getall', 'StudentService::getAll');
$app->get('/student/getalive', 'StudentService::getAlive');
$app->get('/student/getnotalive', 'StudentService::getNotAlive');
$app->get('/student/add', 'StudentService::add');
$app->get('/student/update', 'StudentService::update');
$app->get('/student/retire', 'StudentService::retire');
$app->get('/student/delete', 'StudentService::delete');

$app->get('/teacher/get', 'TeacherService::get');
$app->get('/teacher/getall', 'TeacherService::getAll');
$app->get('/teacher/getalive', 'TeacherService::getAlive');
$app->get('/teacher/getnotalive', 'TeacherService::getNotAlive');
$app->get('/teacher/add', 'TeacherService::add');
$app->get('/teacher/update', 'TeacherService::update');
$app->get('/teacher/retire', 'TeacherService::retire');
$app->get('/teacher/delete', 'TeacherService::delete');

$app->get('/teacherability/get', 'TeacherAbilityService::get');
$app->get('/teacherability/getall', 'TeacherAbilityService::getAll');
$app->get('/teacherability/add', 'TeacherAbilityService::add');
$app->get('/teacherability/update', 'TeacherAbilityService::update');
$app->get('/teacherability/delete', 'TeacherAbilityService::delete');

$app->get('/teacherholiday/get', 'TeacherHolidayService::get');
$app->get('/teacherholiday/getall', 'TeacherHolidayService::getAll');
$app->get('/teacherholiday/add', 'TeacherHolidayService::add');
$app->get('/teacherholiday/update', 'TeacherHolidayService::update');
$app->get('/teacherholiday/delete', 'TeacherHolidayService::delete');

$app->get('/teacherdefaultholiday/get', 'TeacherDefaultHolidayService::get');
$app->get('/teacherdefaultholiday/getall', 'TeacherDefaultHolidayService::getAll');
$app->get('/teacherdefaultholiday/add', 'TeacherDefaultHolidayService::add');
$app->get('/teacherdefaultholiday/update', 'TeacherDefaultHolidayService::update');
$app->get('/teacherdefaultholiday/delete', 'TeacherDefaultHolidayService::delete');

$app->run();


/*
 *  begin to operate FirstCourse
 */
class FirstCourseService{
    static function get(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOFirstCourseOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    static function getAll(Request $request, Response $response){
        $operator = new PDOFirstCourseOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    static function add(Request $request, Response $response){
        $o = array();
        $o[grade] = $request->getParam('grade');
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[description] = $request->getParam('description');

        $operator = new PDOFirstCourseOperation();
        $operator->add($o);
    }

    static function update(Request $request, Response $response){
        $o = array();
        $o[id] = $request->getParam('id');
        $o[grade] = $request->getParam('grade');
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[description] = $request->getParam('description');

        $operator = new PDOFirstCourseOperation();
        $operator->update($o);
    }

    static function delete(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOFirstCourseOperation();
        $operator->delete($key);
    }
}



/*
*  begin to operate SecondCourse
*/
class SecondCourseService{
    static function get(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOSecondCourseOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    static function getAll(Request $request, Response $response){
        $operator = new PDOSecondCourseOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    static function add(Request $request, Response $response){
        $o = array();
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[firstcourseid] = $request->getParam('firstcourseid');
        $o[description] = $request->getParam('description');

        $operator = new PDOSecondCourseOperation();
        $operator->add($o);
    }

    static function update(Request $request, Response $response){
        $o = array();
        $o[id] = $request->getParam('id');
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[firstcourseid] = $request->getParam('firstcourseid');
        $o[description] = $request->getParam('description');

        $operator = new PDOSecondCourseOperation();
        $operator->update($o);
    }

    static function delete(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOSecondCourseOperation();
        $operator->delete($key);
    }
}


/*
*  begin to operate Student
*/
class StudentService{
    static function get(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOStudentOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    static function getAll(Request $request, Response $response){
        $operator = new PDOStudentOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    static function getAlive(){
        $operator = new PDOStudentOperation();
        $list = $operator->getAlive();
        $result = json_encode($list);
        echo $result;
    }

    static function getNotAlive(){
        $operator = new PDOStudentOperation();
        $list = $operator->getNotAlive();
        $result = json_encode($list);
        echo $result;
    }

    static function add(Request $request, Response $response){
        $o = array();
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[grade] = $request->getParam('grade');
        $o[testscore] = $request->getParam('testscore');
        $o[targetscore] = $request->getParam('targetscore');
        $o[examinedate] = $request->getParam('examinedate');
        $o[examineplace] = $request->getParam('examineplace');
        $o[teacherid] = $request->getParam('teacherid');
        $o[description] = $request->getParam('description');

        $operator = new PDOStudentOperation();
        $operator->add($o);
    }

    static function update(Request $request, Response $response){
        $o = array();
        $o[id] = $request->getParam('id');
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[grade] = $request->getParam('grade');
        $o[testscore] = $request->getParam('testscore');
        $o[targetscore] = $request->getParam('targetscore');
        $o[examinedate] = $request->getParam('examinedate');
        $o[examineplace] = $request->getParam('examineplace');
        $o[teacherid] = $request->getParam('teacherid');
        $o[description] = $request->getParam('description');

        $operator = new PDOStudentOperation();
        $operator->update($o);
    }

    static function retire(Request $request, Response $response){
        $key = $request->getParam('id');

        $operator = new PDOStudentOperation();
        $operator->retire($key);
    }

    static function delete(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOStudentOperation();
        $operator->delete($key);
    }
}


/*
 * begin to operate Teacher
 */
class TeacherService{
    static function get(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOTeacherOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    static function getAll(Request $request, Response $response){
        $operator = new PDOTeacherOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    static function getAlive(){
        $operator = new PDOTeacherOperation();
        $list = $operator->getAlive();
        $result = json_encode($list);
        echo $result;
    }

    static function getNotAlive(){
        $operator = new PDOTeacherOperation();
        $list = $operator->getNotAlive();
        $result = json_encode($list);
        echo $result;
    }

    static function add(Request $request, Response $response){
        $o = array();
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[phone] = $request->getParam('phone');
        $o[ismaster] = $request->getParam('ismaster');

        $operator = new PDOTeacherOperation();
        $operator->add($o);
    }

    static function update(Request $request, Response $response){
        $o = array();
        $o[id] = $request->getParam('id');
        $o[name] = $request->getParam('name');
        $o[shortname] = $request->getParam('shortname');
        $o[phone] = $request->getParam('phone');
        $o[ismaster] = $request->getParam('ismaster');

        $operator = new PDOTeacherOperation();
        $operator->update($o);
    }

    static function retire(Request $request, Response $response){
        $key = $request->getParam('id');

        $operator = new PDOTeacherOperation();
        $operator->retire($key);
    }

    static function delete(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOTeacherOperation();
        $operator->delete($key);
    }
}



/*
 * begin to operate TeacherAbility
 */
class TeacherAbilityService{
    static function get(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOTeacherAbilityOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    static function getAll(Request $request, Response $response){
        $operator = new PDOTeacherAbilityOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    static function add(Request $request, Response $response){
        $o = array();
        $o[teacherid] = $request->getParam('teacherid');
        $o[courseid] = $request->getParam('courseid');

        $operator = new PDOTeacherAbilityOperation();
        $operator->add($o);
    }

    static function update(Request $request, Response $response){
        $o = array();
        $o[id] = $request->getParam('id');
        $o[teacherid] = $request->getParam('teacherid');
        $o[courseid] = $request->getParam('courseid');

        $operator = new PDOTeacherAbilityOperation();
        $operator->update($o);
    }

    static function delete(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOTeacherAbilityOperation();
        $operator->delete($key);
    }
}


/*
 * begin to operate TeacherDefaultHoliday
 */
class TeacherHolidayService{
    static function get(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOTeacherHolidayOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    static function getAll(Request $request, Response $response){
        $operator = new PDOTeacherHolidayOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    static function add(Request $request, Response $response){
        $o = array();
        $o[teacherid] = $request->getParam('teacherid');
        $o[adjustdate] = $request->getParam('adjustdate');
        $o[isholiday] = $request->getParam('isholiday');

        $operator = new PDOTeacherHolidayOperation();
        $operator->add($o);
    }

    static function update(Request $request, Response $response){
        $o = array();
        $o[id] = $request->getParam('id');
        $o[teacherid] = $request->getParam('teacherid');
        $o[adjustdate] = $request->getParam('adjustdate');
        $o[isholiday] = $request->getParam('isholiday');

        $operator = new PDOTeacherHolidayOperation();
        $operator->update($o);
    }

    static function delete(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOTeacherHolidayOperation();
        $operator->delete($key);
    }
}

/*
 * begin to operate TeacherHoliday
 */
class TeacherDefaultHolidayService{
    static function get(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOTeacherDefaultHolidayOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    static function getAll(Request $request, Response $response){
        $operator = new PDOTeacherDefaultHolidayOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    static function add(Request $request, Response $response){
        $o = array();
        $o[teacherid] = $request->getParam('teacherid');
        $o[week1] = $request->getParam('week1');
        $o[week2] = $request->getParam('week2');
        $o[week3] = $request->getParam('week3');
        $o[week4] = $request->getParam('week4');
        $o[week5] = $request->getParam('week5');
        $o[week6] = $request->getParam('week6');
        $o[week7] = $request->getParam('week7');

        $operator = new PDOTeacherDefaultHolidayOperation();
        $operator->add($o);
    }

    static function update(Request $request, Response $response){
        $o = array();
        $o[id] = $request->getParam('id');
        $o[teacherid] = $request->getParam('teacherid');
        $o[week1] = $request->getParam('week1');
        $o[week2] = $request->getParam('week2');
        $o[week3] = $request->getParam('week3');
        $o[week4] = $request->getParam('week4');
        $o[week5] = $request->getParam('week5');
        $o[week6] = $request->getParam('week6');
        $o[week7] = $request->getParam('week7');

        $operator = new PDOTeacherDefaultHolidayOperation();
        $operator->update($o);
    }

    static function delete(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOTeacherDefaultHolidayOperation();
        $operator->delete($key);
    }
}


/*
 * begin to operate TeacherHoliday
 */
class ScheduleService{
    static function get(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOScheduleOperation();
        $o = $operator->get($key);
        $result = json_encode($o);
        echo $result;
    }

    static function getAll(Request $request, Response $response){
        $operator = new PDOScheduleOperation();
        $list = $operator->getAll();
        $result = json_encode($list);
        echo $result;
    }

    static function getSecondCourseList(Request $request, Response $response){
        $studentId = $request->getParam('studentId');
        $firstCourseId = $request->getParam('firstCourseId');
        $operator = new PDOScheduleOperation();
        $o = $operator->
        $result = json_encode($o);
        echo $result;
    }

    static function getTeacherListByGet(Request $request, Response $response){
        $onDate = $request->getParam('onDate');
        $onTime = $request->getParam('onTime');
        $firstCourseId = $request->getParam('firstCourseId');
        $operator = new PDOScheduleOperation();
        $o = $operator->get
        $result = json_encode($o);
        echo $result;
    }

    static function add(Request $request, Response $response){
        $o = array();
        $o[ondate] = $request->getParam('ondate');
        $o[ontime] = $request->getParam('ontime');
        $o[studentid] = $request->getParam('studentid');
        $o[courseid] = $request->getParam('courseid');
        $o[teacherid] = $request->getParam('teacherid');
        $o[addition] = $request->getParam('addition');
        $o[description] = $request->getParam('description');

        $operator = new PDOScheduleOperation();
        $operator->add($o);
    }

    static function update(Request $request, Response $response){
        $o = array();
        $o[id] = $request->getParam('id');
        $o[ondate] = $request->getParam('ondate');
        $o[ontime] = $request->getParam('ontime');
        $o[studentid] = $request->getParam('studentid');
        $o[courseid] = $request->getParam('courseid');
        $o[teacherid] = $request->getParam('teacherid');
        $o[addition] = $request->getParam('addition');
        $o[description] = $request->getParam('description');

        $operator = new PDOScheduleOperation();
        $operator->update($o);
    }

    static function delete(Request $request, Response $response){
        $key = $request->getParam('id');
        $operator = new PDOScheduleOperation();
        $operator->delete($key);
    }
}
