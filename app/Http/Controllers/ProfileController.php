<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function view()
    {
        if (Auth::check()) {
            $data = Profile::where('user_id', Auth::id())->get();
            if (empty($data)) {
                $data = null;
            }
            return view('profile', ['data' => $data [0]]);
        } else {
            return redirect()->route('login');
        }
    }
}
