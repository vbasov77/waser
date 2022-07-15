<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypeController extends Controller
{

    public static function getCarType(int $class_auto)
    {
        if ($class_auto == 1) {
            $class = "Легковые";
        }
        if ($class_auto == 2) {
            $class = "Кроссоверы";
        }
        if ($class_auto == 3) {
            $class = "Джипы";
        }
        if ($class_auto == 4) {
            $class = "Минивены";
        }
        return $class;
    }

}
