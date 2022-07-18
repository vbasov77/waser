<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Booking;
use App\Models\Objects;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function viewObj()
    {
        $objects = Objects::where('company_id', Auth::id())->get();
        return view('objects/my_objects', ['objects' => $objects]);
    }

    public function today(int $id)
    {
        $today = date('d.m.Y');
        $array = DateController::inOrder($today, (string)$id);
        return view('orders/orders')->with(['data' => $array, 'date' => $today, 'obj_id' => $id]);
    }

    public function viewCal(int $id)
    {
        return view('orders/orders_cal', ['id' => $id]);
    }

    public function view()
    {
        $today = date('d.m.Y');
        if (Auth::check()) {
            if (!empty($_GET)) {
                $_POST['date'] = $_GET ['data'];
                $_POST['obj_id'] = $_GET['obj_id'];

            }
            $array = DateController::inOrder($_POST['date'], $_POST['obj_id']); //Формируем даты по порядку
            if (strtotime($today) == strtotime($_POST['date'])) {
                $obj_id = $_POST ['obj_id'];
            } else {
                $obj_id = null;
            }
            return view('orders/orders')->with(['data' => $array, 'date' => $_POST['date'], 'obj_id' => $obj_id]);
        } else {
            return redirect()->route('login');
        }
    }

    public function myOrders()
    {
        if (Auth::check()) {
            $data = Booking::where('user_email', Auth::user()->email)->get();
            $num = Profile::where('user_id', Auth::id())->value('auto_user');
            return view('orders/my_orders', ['data' => $data, 'num' => $num]);
        } else {
            return redirect()->route('login');
        }
    }

    public function deleteDat(string $id)
    {
        $i = explode(';', $id);
        Booking::where('id', $i[0])->delete();
        return redirect()->action('OrdersController@view', ['data' => $i[1], 'obj_id' => $i[2]]);
    }

    public function delete(int $id)
    {
        Booking::where('id', $id)->delete();
        return redirect()->back();
    }

    public function inArchive()
    {
        $booking = Booking::where('id', $_POST['id'])->get();
        $_GET['obj_id'] = $booking [0]->obj_id;
        $_GET['data'] = $booking[0]->date_book;
        foreach ($booking[0] as $book) {
            if ($book !== 'time_book') {
                $info[] = $book;
            }
        }
        $info_book = implode('&', $info);
        $data = [
            'info_book' => $info_book,
            'comment_admin' => $_POST['comment_admin']
        ];
        Archive::insert($data);
        Booking::where('id', $_POST['id'])->delete();
        return redirect()->action('OrdersController@view', $_GET);
    }
}
