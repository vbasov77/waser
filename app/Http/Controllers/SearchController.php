<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function view()
    {
        if (empty($_GET['message'])) {
            $message = null;
        } else {
            $message = $_GET['message'];
        }
        return view('search/view', ['message' => $message]);
    }
    public function searchPhone()
    {
        $phone = $_POST ['phone'];
        $profile =  Profile::where('phone_user', $phone)->get();
        if (!empty($profile)) {
            $user = User::where('id', $profile[0]->user_id)->get();
        } else {
            $user = null;
            $profile = null;
        }
        return view('search/user_phone', [
            'profile' => $profile[0],
            'user' => $user[0]
        ]);
    }

    public function updateUser()
    {
        $data = [
            'name' => $_POST['name']
        ];
        User::where('id', $_POST['id'])->update($data);
        $value = [
            'phone_user' => $_POST['phone'],
            'auto_user' => mb_strtoupper($_POST['auto_user'])//перевели в верхний регистр
        ];
        Profile::where('id', $_POST['profile_id'])->update($value);
        $message = "Настройки сохранены";
        return redirect()->action('SearchController@view', ['message' => $message]);
    }


}
