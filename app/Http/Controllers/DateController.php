<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DateController extends Controller
{
    public static function inOrder(string $date, string $obj_id)
    {

        $result = DB::table('booking')->where('date_book', $date)->where('obj_id', $obj_id)->get();
        $res = json_decode(json_encode($result), true);

        if (!empty($res)) {
            for ($i = 0; $i < count($res); $i++) {
                $time = explode(";", $res [$i]['time_book']);

                $arr[] = strtotime($time [0]);
            }

            sort($arr);
            foreach ($arr as $item) {
                $ar = (string)date('H:i', $item);
                $r = DB::table('booking')->where('time_wash', $ar)->where('date_book', $date)->get();
                $arri [] = json_decode(json_encode($r), true);
            }
        } else {
            $arri = "";
        }
        return $arri;
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
