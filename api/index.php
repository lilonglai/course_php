<?php
/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/2/20
 * Time: 11:56
 */


require __DIR__ . "/../vendor/autoload.php";

require __DIR__ . "/FirstCourseService.php";
require __DIR__ . "/SecondCourseService.php";
require __DIR__ . "/StudentService.php";
require __DIR__ . "/TeacherService.php";
require __DIR__ . "/TeacherAbilityService.php";
require __DIR__ . "/TeacherHolidayService.php";
require __DIR__ . "/TeacherDefaultHolidayService.php";
require __DIR__ . "/ScheduleService.php";

use \Slim\Http\Request;
use \Slim\Http\Response;

$app = new \Slim\App();

$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    return $response->write("Hello, " . $args['name']);
});

$app->get('/firstcourse/get', 'FirstCourseService::get');
$app->get('/firstcourse/getAll', 'FirstCourseService::getAll');
$app->post('/firstcourse/add', 'FirstCourseService::add');
$app->put('/firstcourse/update', 'FirstCourseService::update');
$app->get('/firstcourse/delete', 'FirstCourseService::delete');

$app->get('/secondcourse/get', 'SecondCourseService::get');
$app->get('/secondcourse/getAll', 'SecondCourseService::getAll');
$app->post('/secondcourse/add', 'SecondCourseService::add');
$app->put('/secondcourse/update', 'SecondCourseService::update');
$app->delete('/secondcourse/delete', 'SecondCourseService::delete');

$app->get('/student/get', 'StudentService::get');
$app->get('/student/getAll', 'StudentService::getAll');
$app->get('/student/getAlive', 'StudentService::getAlive');
$app->get('/student/getNotAlive', 'StudentService::getNotAlive');
$app->post('/student/add', 'StudentService::add');
$app->put('/student/update', 'StudentService::update');
$app->get('/student/retire', 'StudentService::retire');
$app->delete('/student/delete', 'StudentService::delete');

$app->get('/teacher/get', 'TeacherService::get');
$app->get('/teacher/getAll', 'TeacherService::getAll');
$app->get('/teacher/getAlive', 'TeacherService::getAlive');
$app->get('/teacher/getNotAlive', 'TeacherService::getNotAlive');
$app->post('/teacher/add', 'TeacherService::add');
$app->put('/teacher/update', 'TeacherService::update');
$app->get('/teacher/retire', 'TeacherService::retire');
$app->delete('/teacher/delete', 'TeacherService::delete');

$app->get('/teacherability/get', 'TeacherAbilityService::get');
$app->get('/teacherability/getAll', 'TeacherAbilityService::getAll');
$app->post('/teacherability/add', 'TeacherAbilityService::add');
$app->put('/teacherability/update', 'TeacherAbilityService::update');
$app->delete('/teacherability/delete', 'TeacherAbilityService::delete');

$app->get('/teacherholiday/get', 'TeacherHolidayService::get');
$app->get('/teacherholiday/getAll', 'TeacherHolidayService::getAll');
$app->post('/teacherholiday/add', 'TeacherHolidayService::add');
$app->put('/teacherholiday/update', 'TeacherHolidayService::update');
$app->delete('/teacherholiday/delete', 'TeacherHolidayService::delete');

$app->get('/teacherdefaultholiday/get', 'TeacherDefaultHolidayService::get');
$app->get('/teacherdefaultholiday/getAll', 'TeacherDefaultHolidayService::getAll');
$app->post('/teacherdefaultholiday/add', 'TeacherDefaultHolidayService::add');
$app->put('/teacherdefaultholiday/update', 'TeacherDefaultHolidayService::update');
$app->delete('/teacherdefaultholiday/delete', 'TeacherDefaultHolidayService::delete');

$app->get('/schedule/get', 'ScheduleService::get');
$app->get('/schedule/getAll', 'ScheduleService::getAll');
$app->get('/schedule/getAvailableSecondCourseList', 'ScheduleService::getAvailableSecondCourseList');
$app->get('/schedule/getAvailableTeacherListByAbility', 'ScheduleService::getAvailableTeacherListByAbility');
$app->get('/schedule/getAvailableTeacherList', 'ScheduleService::getAvailableTeacherList');
$app->get('/schedule/getSecondCourseAndTeacherList', 'ScheduleService::getSecondCourseAndTeacherList');
$app->post('/schedule/add', 'ScheduleService::add');
$app->put('/schedule/update', 'ScheduleService::update');
$app->delete('/schedule/delete', 'ScheduleService::delete');

$app->run();

