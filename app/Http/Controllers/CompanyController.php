<?php

namespace App\Http\Controllers;

use App\Models\Objects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function view()
    {
        return view('/');
    }

    public function cabinet()
    {
        $objects = Objects::where('company_id', Auth::id())->get();
        return view('company.cabinet', ['objects' => $objects]);
    }


    public function addView()
    {
        return view('/company/add');
    }
}
