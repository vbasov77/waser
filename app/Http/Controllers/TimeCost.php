<?php

namespace App\Http\Controllers;

use App\Models\SetWash;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class TimeCost extends Controller
{
    public function view()
    {
        return view('/');
    }

    public function timeCost()
    {
        $class_auto = 0;
        $time_c = $_POST['time_cost'];
        for ($i = 0; $i < 4; $i++) {
            $name_wash= 0;
            $class_auto = $class_auto + 1;
            for ($z = 0; $z < 4; $z++) {
                $name_wash = $name_wash + 1;
                $time_cost = $time_c[$i][$z];
                $data = [
                    'class_auto' => $class_auto,
                    'name_wash' => $name_wash,
                    'time_cost' => $time_cost
                ];
                echo "$class_auto; $name_wash; $time_cost <br>";
               SetWash::where('class_auto', $class_auto)->where('name_wash', $name_wash)->update($data);
            }
        }
        return view('/home');
    }
}
