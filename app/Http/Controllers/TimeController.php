<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class TimeController extends Controller
{
    public static function SlicerTime(string $min, string $max, int $step)
    {
        for (
            $i = strtotime($min);
            $i <= strtotime($max);
            $i = $i + $step * 60
        ) {
            $slots[] = date("H:i", $i);
        }
        return $slots;
    }

    public static function GetCloseTimeArr(int $time_client, array $time_closed, array $working_day_table, int $slot_step)
    {
        if ($time_client <= 15) {
            $time_client = 15;
        } elseif ($time_client > 15 && $time_client <= 30) {
            $time_client = 30;
        } elseif ($time_client > 30 && $time_client <= 45) {
            $time_client = 45;
        } elseif ($time_client > 45 && $time_client <= 60) {
            $time_client = 60;
        } elseif ($time_client > 60 && $time_client <= 75) {
            $time_client = 75;
        } elseif ($time_client > 75 && $time_client <= 90) {
            $time_client = 90;
        } elseif ($time_client > 90 && $time_client <= 105) {
            $time_client = 105;
        } elseif ($time_client > 105 && $time_client <= 120) {
            $time_client = 120;
        } else {
            $time_client = 135;
        }
        $more_closed = [];
        foreach ($time_closed as $time_one) {
            // Получаем время, до которого нельзя занимать
            $hours = floor($time_client / 60);
            $minutes = $time_client % 60;
            $time_format = sprintf('%02d:%02d', $hours, $minutes);
            $time1 = strtotime($time_one);
            $time2 = strtotime($time_format);  // Время клиента
            $diff = $time1 - $time2;
            $time_minus = gmdate('H:i', $diff);// До времени, которое нельзя занимать
            $more_closed[] = TimeController::SlicerTime($time_minus, $time_one, $slot_step);
        }
        $time_pred = [];
        for ($ii = 0; $ii < count($more_closed); $ii++) {
            unset($more_closed[$ii][0]);
            $time_pred[] = array_values($more_closed[$ii]);
        }
        for ($i = 0; $i < count($time_pred); $i++) {
            $working_day_table = array_diff($working_day_table, $time_pred[$i]);
        }
        $time = array_values($working_day_table);
        if (!empty($time)) {
            return $time;
        } else {
            return null;
        }
    }

    public static function todayCheck(array $time, string $date)
    {
        $today = date('d.m.Y');
        if (strtotime($today) == strtotime($date)) {
            $to_time = date("H:i");
            $i = strtotime($to_time) - 900;
            foreach ($time as $item) {
                if ($i < strtotime($item)) {
                    $new_time [] = $item;
                }
            }
            return $new_time;
        } else {
            return $time;
        }
    }

}
