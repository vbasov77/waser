<?php

namespace App\Http\Controllers;

use App\Models\MoreObj;
use App\Models\Objects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoreObjController extends Controller
{
    public function view(int $id)
    {
        $name_obj = Objects::where('id', $id)->value('name_obj');
        $more_obj = MoreObj::where('obj_id', $id)->get();
        return view('/more_obj/view', ['more_obj' => $more_obj, 'obj_id' => $id, 'name_obj' => $name_obj]);
    }

    public function moreAdd(int $id)
    {
        $type_auto = DateController::GetTypeCar($id);
        return view('/more_obj/add', ['obj_id' => $id, 'type_auto' => $type_auto]);
    }

    public function add()
    {
        $data = [
            'obj_id' => $_POST['obj_id'],
            'number_more' => $_POST['number_more'],
            'name_more' => $_POST['name_more'],
            'descriptions_more' => $_POST['descriptions_more'],
            'cost_more' => $_POST['cost_more'],
            'time_more' => $_POST['time_more'],
            'category' => implode(',', $_POST['category'])
        ];
        MoreObj::insert($data);
        return redirect()->action('MoreObjController@view', ['id' => $_POST['obj_id']]);
    }

    public function moreUpload(string $id)
    {
        $id = explode('&', $id);
        $more_obj = MoreObj::where('id', $id[0])->get();
        $type_auto = DateController::GetTypeCar($id[1]);
        $category = explode(',', $more_obj [0]->category);
        return view('/more_obj/upload', ['more_obj' => $more_obj[0], 'type_auto' => $type_auto, 'category' => $category]);
    }

    public function upload()
    {
        $data = [
            'number_more' => $_POST['number_more'],
            'name_more' => $_POST['name_more'],
            'descriptions_more' => $_POST['descriptions_more'],
            'cost_more' => $_POST['cost_more'],
            'time_more' => $_POST['time_more'],
            'category' => implode(',', $_POST['category'])
        ];
        MoreObj::where('id', $_POST['id'])->update($data);
        return redirect()->action('MoreObjController@view', [$_POST['obj_id']]);
    }

    public function delete(string $id)
    {
        $obj = explode(';', $id);
        MoreObj::where('id', $obj[0])->delete();
        return redirect()->back();
    }


}
