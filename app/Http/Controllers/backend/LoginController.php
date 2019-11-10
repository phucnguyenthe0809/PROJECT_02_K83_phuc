<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function getLogin() {
        return view('backend.login.login');
    }

    function postLogin(LoginRequest $r) {

    }
}
