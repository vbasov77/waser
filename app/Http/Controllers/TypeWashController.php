<?php

namespace App\Http\Controllers;

use App\Models\Objects;
use App\Models\TypeWash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeWashController extends Controller
{


    public function viewWashObj(int $id)
    {
        $name_obj = Objects::where('id', $id)->value('name_obj');
        $type_wash = TypeWash::where('obj_id', $id)->value('name_wash');
        if (!empty($type_wash)) {
            $wash = explode(',', $type_wash);
        } else {
            $wash = null;
        }
        return view('/type_wash/update', ['wash' => $wash, 'obj_id' => $id, 'name_obj' => $name_obj]);
    }

    public function update()
    {
        $type_wash = TypeWash::where('obj_id', $_POST['obj_id'])->value('name_wash');
        $str = implode(',', $_POST['type_wash']);
        $name_wash = preg_replace("/\,+$/", "", $str);//Удалили последнюю запятую
        $params = [
            'obj_id' =>(int)$_POST['obj_id'],
            'name_wash' => (string)$name_wash
        ];
        if (!empty($type_wash)) {
            TypeWash::where('obj_id', $_POST['obj_id'])->update($params);
            return redirect()->action('CompanyController@cabinet');
        } else {
            TypeWash::insert($params);
            return redirect()->action('CompanyController@cabinet');
        }
    }

}
