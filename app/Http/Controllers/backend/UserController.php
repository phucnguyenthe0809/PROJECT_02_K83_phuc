<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function getUser() {
        return view('backend.user.listuser');
    }
    function getAddUser() {
        return view('backend.user.adduser');
    }
    function getEditUser() {
        return view('backend.user.edituser');
    }
}
