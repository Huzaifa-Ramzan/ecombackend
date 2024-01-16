<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function register(Request $req) {
        $modelusers = new Users();
        $modelusers->name = $req->input('name');
        $modelusers->email = $req->input('email');
        $modelusers->password = Hash::make($req->input('password'));
        $modelusers->save();

        return $modelusers;

    }

    public function login(Request $req) {
        $user = DB::table('users')
        ->select('users.*')
        ->where('email',$req->input('email'))
        ->first();

        if ($user && Hash::check($req->input('password'), $user->password)) {
            return $user;
        } else {
            return false;
        }
    }

}
