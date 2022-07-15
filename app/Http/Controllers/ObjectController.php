<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\MoreObj;
use App\Models\Objects;
use App\Models\TypeAuto;
use App\Models\TypeWash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ObjectController extends Controller
{
    public function view(int $id)
    {
        $data = Objects::where('id', $id)->get();
        $type_auto = TypeAuto::where('obj_id', $id)->value('name_auto');
        $auto = explode(',', $type_auto);
        return view('/objects/view', ['data' => $data[0], 'auto' => $auto]);
    }

    public function addObject()
    {
        $data = [
            'company_id' => Auth::id(),
            'name_obj' => $_POST['name_obj'],
            'address_obj' => $_POST['address_obj'],
            'phone_obj' => $_POST['phone_obj'],
            'working_hours' => $_POST['working_hours'],
            'coordinates' => $_POST['coordinates'],
            'load_obj' => $_POST['load_obj'],

        ];
        Objects::insert($data);
        return redirect()->action('CompanyController@cabinet');
    }

    public function viewUpdateObj(int $id)
    {
        $objects = Objects::where('id', $id)->get();
        return view('company/update', ['object' => $objects[0]]);
    }

    public function updateObj()
    {
        $data = [
            'name_obj' => $_POST['name_obj'],
            'address_obj' => $_POST['address_obj'],
            'phone_obj' => $_POST['phone_obj'],
            'working_hours' => $_POST['working_hours'],
            'coordinates' => $_POST['coordinates'],
            'load_obj' => $_POST['load_obj'],
        ];
        Objects::where('id', $_POST['id'])->update($data);
        return redirect()->action('CompanyController@cabinet');
    }

    public function deleteObj(int $id)
    {
        Objects::where('id', $id)->delete();
        MoreObj::where('obj_id', $id)->delete();
        TypeAuto::where('obj_id', $id)->delete();
        TypeWash::where('obj_id', $id)->delete();
        MoreObj::where('obj_id', $id)->delete();
        Cost::where('obj_id', $id)->delete();

        return redirect()->action('CompanyController@cabinet');
    }

}
