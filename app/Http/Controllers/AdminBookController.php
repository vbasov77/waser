<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Cost;
use App\Models\Objects;
use App\Models\Profile;
use App\Models\TypeAuto;
use App\Models\TypeWash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBookController extends Controller
{
    public function viewAdd(int $id)
    {
        $today = date('d.m.Y');
        $work = explode('-', Objects::where('id', $id)->value('working_hours'));//Получили время работы из BD
        $slot_start = $work[0]; // Время начала рабочего дня
        $slot_end = $work[1]; // Завершение рабочего дня
        $slot_step = 15; // Шаг временной таблицы
        $time_cl = DbController::GetTime($today, $id); // Получили массив занятого времени всех заказов
        // Сбор всех массивов времени в один
        $time_closed = [];
        foreach ($time_cl as $item) {
            $array_time = explode(";", $item);
            foreach ($array_time as $a) {
                $time_closed [] = $a;
            }
        }
        $_POST ['obj_id'] = $id;
        $time_closed = array_keys(array_filter(array_count_values($time_closed), function ($v) {
            $loadObj = Objects::where('id', $_POST['obj_id'])->value('load_obj');
            return $v >= (int)$loadObj;
        }));
        $working_day_table = TimeController::SlicerTime($slot_start, $slot_end, $slot_step);
        $time = array_diff($working_day_table, $time_closed);
        $time = TimeController::todayCheck($time, $today);
        $type_auto = TypeAuto::where('obj_id', $id)->value('name_auto');
        $auto = explode(',', $type_auto);
        $type_wash = explode(',', TypeWash::where('obj_id', $id)->value('name_wash'));

        return view('/admin_book/add', ['work_time' => $time, 'obj_id' => $id, 'auto' => $auto, 'wash' => $type_wash ]);
    }

    public function add()
    {

        $range = range(strtotime($_POST['timepicker'][0]),strtotime($_POST['timepicker'][1]),15*60);
        $time_book = [];
        foreach($range as $time){
            $time_book [] = date("H:i", $time);
        }
        $time_book = implode(";", $time_book);
        $data = [
            'obj_id' => $_POST['obj_id'],
            'name_user' => $_POST['name_user'],
            'user_email' => $_POST['user_email'],
            'phone_user' => $_POST['phone_user'],
            'date_book' => date('d.m.Y'),
            'time_wash' => $_POST['timepicker'][0],
            'time_book' => $time_book,
            'type_auto' => $_POST['class_auto'],
            'type_wash' => $_POST['class_wash'],
            'total_cost' => $_POST['total_cost'],
        ];
        Booking::insert($data);
        return redirect()->action('OrdersController@today', ['id' => $_POST['obj_id']]);
    }


}
