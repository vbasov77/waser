<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DbController extends Controller
{
    public static function GetTime(string $data, int $obj_id){
        $result = Booking::where('date_book', $data)->where('obj_id', $obj_id)->get('time_book');
        $time = [];
        if (!empty($result) != null) {
            for ($i = 0; $i < count($result); $i++){
                $time[] = $result [$i]->time_book;
            }
        }
        return $time;
    }

}
