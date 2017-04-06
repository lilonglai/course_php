<?php
/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/2/20
 * Time: 11:56
 */


require "../vendor/autoload.php";

require "FirstCourseService.php";
require "SecondCourseService.php";
require "StudentService.php";
require "TeacherService.php";
require "TeacherAbilityService.php";
require "TeacherHolidayService.php";
require "TeacherDefaultHolidayService.php";
require "ScheduleService.php";

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

