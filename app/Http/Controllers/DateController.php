<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DateController extends Controller
{
    public static function inOrder(string $date, string $obj_id)
    {
        $result = Booking::where('date_book', $date)->where('obj_id', $obj_id)->get();
        if (!empty($result)) {
            for ($i = 0; $i < count($result); $i++) {
                $time = explode(";", $result[$i]->time_book);
                $array_time[] = strtotime($time [0]);
            }
            sort($array_time);
            foreach ($array_time as $item) {
                $array = (string)date('H:i', $item);
                $book[] = Booking::where('time_wash', $array)->where('date_book', $date)->get();
            }
        } else {
            $book = "";
        }
        return $book;
    }

    public static function GetTypeCar(int $obj_id)
    {
        $result = DB::table('type_auto')->where('obj_id', $obj_id)->value('name_auto');
        if (!empty($result)) {
            $auto = explode(',', $result);
        } else {
            $auto = null;
        }
        return $auto;
    }

}
