<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function view()
    {
        $data = Settings::get();
        return view('settings/settings')->with(['data'=>$data]);
    }

    public function addSettings()
    {
        $data = [
            'name_company' => $_POST['name'],
            'phone_company' => $_POST['phone'],
            'time_open' => $_POST['time_open'],
            'time_closed' => $_POST['time_closed'],
            'step' => $_POST['step'],
            'load_c' => "",
            'day_closed' => "",
            'weekends' => ""
        ];
        Booking::insert($data);
    }

    public function updateSettings() {
        $data = [
            'name_company' => $_POST['name'],
            'phone_company' => $_POST['phone'],
            'time_open' => $_POST['time_open'],
            'time_closed' => $_POST['time_closed'],
            'step' => $_POST['step']
        ];
        Settings::where('id', 1)->update($data);
        $data = Settings::get();
        return view('/settings')->with(['data'=>$data]);
    }
}
