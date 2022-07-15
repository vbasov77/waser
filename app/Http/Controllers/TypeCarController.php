<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Objects;
use App\Models\TypeAuto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Matcher\Type;

class TypeCarController extends Controller
{

    public function viewCategoryObj(int $id)
    {
        $name_obj = Objects::where('id', $id)->value('name_obj');
        $type_auto = TypeAuto::where('obj_id', $id)->value('name_auto');
        if (!empty($type_auto)) {
            $auto = explode(',', $type_auto);
        } else {
            $auto = null;
        }
        return view('/type_auto/update', ['auto' => $auto, 'obj_id' => $id, 'name_obj' => $name_obj]);
    }

    public function update()
    {
        $type_auto = TypeAuto::where('obj_id', $_POST['obj_id'])->value('name_auto');
        $str = implode(',', $_POST['type_auto']);
        $name_auto = preg_replace("/\,+$/", "", $str);//Удалили последнюю запятую
        $params = [
            'obj_id' => (int)$_POST['obj_id'],
            'name_auto' => (string)$name_auto
        ];
        if (!empty($type_auto)) {
            TypeAuto::where('obj_id', $_POST['obj_id'])->update($params);
            return redirect()->action('CompanyController@cabinet');
        } else {
            TypeAuto::insert($params);
            return redirect()->action('CompanyController@cabinet');
        }
    }

    public function view()
    {
        $objects = Objects::all();
        $users_count = DB::table('users')->count();
        return view('front', ['objects' => $objects, 'users_count' => $users_count]);
    }
}
