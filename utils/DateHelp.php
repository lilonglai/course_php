<?php

/**
 * Created by PhpStorm.
 * User: loli
 * Date: 2017/4/6
 * Time: 22:47
 */
class DateHelp
{
    public static function getWeek($date){
        $date = DateTime::createFromFormat("Y-m-d", $date);
        $weekString = $date->format("w");
        $week = (int) $weekString;
        if ($week == 0)
            $week = 7;
        return $week;
    }

    public static function getDaysInMonth($dateString){
        $date = DateTime::createFromFormat("Y-m-d", $dateString);
        $date2 = DateTime::createFromFormat("Y-m-d", $dateString);
        $date2->add(new DateInterval("P1M"));
        $interval = $date2->diff($date);
        $daysString = $interval->format("%a");
        $days = (int) $daysString;
        return $days;
    }

    public static function isHoliday($date, $teacherDefaultHoliday, $holidayList){
        $week = self::getWeek($date);
        $flag = false;
        switch($week){
            case 1:
                $flag = $teacherDefaultHoliday['week1'];
                break;
            case 2:
                $flag = $teacherDefaultHoliday['week2'];
                break;
            case 3:
                $flag = $teacherDefaultHoliday['week3'];
                break;
            case 4:
                $flag = $teacherDefaultHoliday['week4'];
                break;
            case 5:
                $flag = $teacherDefaultHoliday['week5'];
                break;
            case 6:
                $flag = $teacherDefaultHoliday['week6'];
                break;
            case 6:
                $flag = $teacherDefaultHoliday['week7'];
                break;
            default:
                break;
        }

        foreach ($holidayList as $holiday){
            if($holiday['adjustdate'] == $date){
                $flag = $holiday['isholiday'];
            }
        }
        return $flag;
    }
}

/*
echo DateHelp::getDaysInMonth("2017-01-29");
echo DateHelp::getDaysInMonth("2017-02-27");
echo DateHelp::getDaysInMonth("2017-03-31");
echo DateHelp::getDaysInMonth("2017-04-10");
echo DateHelp::getDaysInMonth("2017-05-10");
echo DateHelp::getDaysInMonth("2017-06-10");
echo DateHelp::getDaysInMonth("2017-07-10");
echo DateHelp::getDaysInMonth("2017-08-10");
echo DateHelp::getDaysInMonth("2017-09-10");
echo DateHelp::getDaysInMonth("2017-10-10");
echo DateHelp::getDaysInMonth("2017-11-10");
echo DateHelp::getDaysInMonth("2017-12-10");
*/