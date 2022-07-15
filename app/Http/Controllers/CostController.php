<?php

namespace App\Http\Controllers;

use App\Models\Objects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CostController extends Controller
{
    public function view(int $id)
    {


        $name_obj = Objects::where('id', $id)->value('name_obj');
        $c = DB::table('cost')->where('obj_id', $id)->value('cost');
        $type_auto = explode(',', DB::table('type_auto')->where('obj_id', $id)->value('name_auto'));
        $type_wash = explode(',', DB::table('type_wash')->where('obj_id', $id)->value('name_wash'));
        $cost_obj = null;
        if (!empty($c)) {
           $cost_obj = explode(';', $c);
        }
        $name = [];
        foreach ($type_auto as $auto) {
            foreach ($type_wash as $wash) {
                $name [] = $auto . ":" . $wash;
            }

        }
        $cost = [];
        if (!empty($cost_obj)) {
            foreach ($cost_obj as $obj) {
                $c = explode('&', $obj);
                $cost[] = $c[1];
            }
        }
        return view('/cost/update', ['cost' => $cost, 'obj_id' => $id, 'name_obj' => $name_obj, 'name' => $name]);
    }

    public function update()
    {


        $type_auto = explode(',', DB::table('type_auto')->where('obj_id', $_POST['obj_id'])->value('name_auto'));
        $type_wash = explode(',', DB::table('type_wash')->where('obj_id', $_POST['obj_id'])->value('name_wash'));
        $type_cost = DB::table('cost')->where('obj_id', $_POST['obj_id'])->value('cost');
        $cos = [];
        $name = [];
        foreach ($type_auto as $auto) {
            foreach ($type_wash as $wash) {
                $name [] = $auto . ":" . $wash;
            }

        }
        for ($i = 0; $i < count($_POST['cost']); $i++) {
            $cos[] = $name [$i] . "&" . $_POST ['cost'] [$i];
        }
        $cost = implode(';', $cos);
        $params = [
            'obj_id' => (int)$_POST['obj_id'],
            'cost' => (string)$cost
        ];

        if (!empty($type_cost)) {
            DB::table('cost')->where('obj_id', $_POST['obj_id'])->update($params);
            return redirect()->action('CompanyController@cabinet');
        } else {
            DB::table('cost')->insert($params);
            return redirect()->action('CompanyController@cabinet');
        }

    }

}
