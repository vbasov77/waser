<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidArgumentException;
use App\Mail\SendBooking;
use App\Mail\SendBookingAdmin;
use App\Mail\SendRegister;
use App\Models\Cost;
use App\Models\MoreObj;
use App\Models\Objects;
use App\Models\Profile;
use App\Models\TypeWash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CalendarController extends Controller
{
    public function view()
    {
        $date_dis = ['01.5.2022', '02.5.2022', '03.5.2022',];
        $car = $_POST['class_auto'];
        $db_more = MoreObj::where('obj_id', $_POST['obj_id'])->get();
        $more_obj = null;
        if (!empty($db_more)) {
            foreach ($db_more as $item) {
                $category = explode(',', $item['category']);
                if (!empty(in_array($car, $category))) {
                    $more_obj[] = $item;
                }
            }
        }
        $costWashStr = Cost::where('obj_id', $_POST['obj_id'])->get();
        $costWashArr = explode(';', $costWashStr[0]->cost);
        $type_wash = explode(',', TypeWash::where('obj_id', $_POST['obj_id'])->value('name_wash'));
        return view('set', ['datedis' => $date_dis, 'class_auto' => $_POST ['class_auto'], 'car' => $car, 'obj_id' => $_POST['obj_id'], 'more_obj' => $more_obj, 'wash' => $type_wash, 'costWashArr' => $costWashArr]);
    }

    public function CalendarPost()
    {
        $sum_time_more = 0;
        $sum_cost_more = 0;
        if (!empty($_POST['more_obj'])) {
            $times_arr = [];
            $costs_arr = [];
            foreach ($_POST['more_obj'] as $value) {
                $more_arr = explode(',', $value);
                $times_arr [] = $more_arr[4];
                $costs_arr [] = $more_arr[3];
            }
            $sum_time_more = array_sum($times_arr);
            $sum_cost_more = array_sum($costs_arr);
            $more_obj = implode(';', $_POST ['more_obj']);
        } else {

            $more_obj = null;
        }
        if (empty($_POST['class_wash'])) {
            try {
                throw new InvalidArgumentException("Вы не выбрали вид мойки :((");
            } catch (InvalidArgumentException $e) {
                $date_dis = [];// Массив БД - занятые дни
                $car = TypeController::getCarType($_POST['class_auto']);
                return view('set')->with(['error' => $e->getMessage(), 'datedis' => $date_dis, 'class_auto' => $_POST ['class_auto'], 'car' => $car]);
            }
        }
        if (empty($_POST['el'])) {
            try {
                throw new InvalidArgumentException("Вы не выбрали дату :((");
            } catch (InvalidArgumentException $e) {
                $date_dis = [];// Массив БД - занятые дни
                $car = TypeController::getCarType($_POST['class_auto']);
                return view('set')->with(['error' => $e->getMessage(), 'datedis' => $date_dis, 'class_auto' => $_POST ['class_auto'], 'car' => $car]);
            }
        }
        $work = explode('-', Objects::where('id', $_POST['obj_id'])->value('working_hours'));
        $slot_start = $work[0]; // Время начала рабочего дня
        $slot_end = $work[1]; // Завершение рабочего дня
        $slot_step = 15; // Шаг временной таблицы
        $string_slass = $_POST['class_auto'] . ":" . $_POST['class_wash'];
        $cost_obj = explode(';', Cost::where('obj_id', $_POST['obj_id'])->value('cost'));
        foreach ($cost_obj as $obj) {
            $a = explode('&', $obj);
            if ((string)$string_slass === $a[0]) {
                $cost_arr = explode('/', $a[1]);
                $time_client = $cost_arr[1];
                $sum = $cost_arr[0];
                break;
            }
        }
        $sum = $sum + $sum_cost_more;
        $time_client = $time_client + $sum_time_more;
        $time_cl = DbController::GetTime($_POST ['el'], $_POST['obj_id']);

        $time_closed = [];
        foreach ($time_cl as $item) {
            $array_time = explode(";", $item);
            foreach ($array_time as $a) {
                $time_closed [] = $a;
            }
        }

        $time_closed = array_keys(array_filter(array_count_values($time_closed), function ($v) {
            $loadObj = Objects::where('id', $_POST['obj_id'])->value('load_obj');
            return $v >= (int)$loadObj;
        }));


        if (Auth::check()) {
            $profile_db = Profile::where('user_id', Auth::id())->get();
            if (empty($profile_db)) {
                $profile = null;
            } else {
                $profile = [
                    'email' => Auth::user()->email,
                    'phone_user' => $profile_db[0]->phone_user,
                    'auto_user' => $profile_db[0]->auto_user
                ];
            }
        } else {
            $profile = null;
        }
        $working_day_table = TimeController::SlicerTime($slot_start, $slot_end, $slot_step);
        $time = TimeController::GetCloseTimeArr($time_client, $time_closed, $working_day_table, $slot_step);
        $time = TimeController::todayCheck($time, $_POST ['el']);
        if ($time != null) {
            return view('time')->with(['profile' => $profile, 'time' => $time, 'el' => $_POST['el'], 'class_auto' => $_POST['class_auto'], 'time_client' => $time_client, 'class_wash' => $_POST['class_wash'], 'obj_id' => $_POST ['obj_id'], 'more_obj' => $more_obj, 'cost' => $sum]);
        } else {
            $message = 'К сожалению, всё время занято на выбранную вами дату. 
            Измените дату или вернитесь на главную страницу для выбора другого сервиса';
            $costWashStr = Cost::where('obj_id', $_POST['obj_id'])->get();
            $costWashArr = explode(';', $costWashStr[0]->cost);
            $date_dis = [];
            $type_wash = explode(',', TypeWash::where('obj_id', $_POST['obj_id'])->value('name_wash'));
            $more_obj = MoreObj::where('obj_id', $_POST['obj_id'])->get();
            return view('set', ['wash' => $type_wash, 'datedis' => $date_dis, 'message' => $message, 'obj_id' => $_POST['obj_id'], 'car' => $_POST['class_auto'], 'costWashArr' => $costWashArr, 'more_obj' => $more_obj]);
        }
    }

    public function Booking()
    {
        if (Auth::check()) {
            $profile_db = Profile::where('user_id', Auth::id())->get();
            if (empty($profile_db)) {
                Profile::insert([
                    'user_id' => Auth::id(),
                    'phone_user' => $_POST['phone'],
                    'auto_user' => mb_strtoupper($_POST['auto_user'])//перевели в верхний регистр
                ]);
            }
        }
        $users = User::all();
        $users_email = [];
        foreach ($users as $value) {
            $users_email [] = $value->email;
        }
        $email = preg_replace("/\s+/", "", $_POST ['email_user']);
        if (empty(in_array($email, $users_email))) {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $password = substr(str_shuffle($permitted_chars), 0, 16);
            User::insert([
                'name' => $_POST['name'],
                'email' => $email,
                'password' => Hash::make($password),
            ]);
            $user_id = User::where('email', $email)->value('id');
            Profile::insert([
                'user_id' => $user_id,
                'phone_user' => $_POST['phone'],
                'auto_user' => mb_strtoupper($_POST['auto_user'])//перевели в верхний регистр
            ]);
            $params = [
                'name_user' => $_POST['name'],
                'email_user' => $email,
                'password' => $password,
                'url' => request()->root(),
            ];
            $subject2 = 'Регистрация на сайте';
            $toEmail2 = $email;
            Mail::to($toEmail2)->send(new SendRegister($subject2, $params));
        }
        $time_client = $_POST['time_client'];
        $time_form = new \DateTime($_POST['timepicker']);
        $time_form->add(new \DateInterval('PT' . $time_client . 'M'));
        $end_time = $time_form->format('H:i');
        $slot_step = 15;
        for (
            $i = strtotime($_POST['timepicker']);
            $i <= strtotime($end_time);
            $i = $i + $slot_step * 60
        ) {
            $slots[] = date("H:i", $i);
        }

        if ($time_client <= 15) {
            array_pop($slots);
        }
        $time = implode(';', $slots);
        $address = Objects::where('id', $_POST['obj_id'])->value('address_obj');
        $data = [
            'obj_id' => $_POST['obj_id'],
            'time_book' => $time,
            'date_book' => $_POST['el'],
            'type_auto' => $_POST['class_auto'],
            'type_wash' => $_POST['class_wash'],
            'name_user' => $_POST['name'],
            'time_wash' => $_POST['timepicker'],
            'total_cost' => $_POST['cost'],
            'phone_user' => $_POST['phone'],
            'user_email' => preg_replace("/\s+/", "", $_POST['email_user']),
            'more_book' => $_POST['more_obj'],
        ];
        $send_mail = [
            'name_user' => $_POST['name'],
            'date_book' => $_POST['el'],
            'time_wash' => $_POST['timepicker'],
            'total_cost' => $_POST['cost'],
            'address' => $address
        ];
        $admin_id = Objects::where('id', $_POST['obj_id'])->value('company_id');
        $email_admin = User::where('id', $admin_id)->value('email');
        $subj = 'Запись на мойку';
        $toEmail = $email;
        Mail::to($toEmail)->send(new SendBooking($subj, $send_mail));
        Mail::to($email_admin)->send(new SendBookingAdmin($subj, $send_mail));
        DB::table('booking')->insert($data);
        $mess = "Вы записались на мойку автомобиля по адресу: $address<br>Дата: {$_POST['el']}<br> Время: {$_POST['timepicker']}<br><br>Для того, чтобы управлять бронированием, пройдите в <a href='/my_orders'>Мои заказы</a>";
        return redirect()->action('DankeController@view', ['mess' => $mess]);
    }


}
