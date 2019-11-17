<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    function getUser() {
        $data['users']=User::paginate(3);
        return view('backend.user.listuser',$data);
    }

    function getAddUser() {
        return view('backend.user.adduser');
    }
    function postAddUser(AddUserRequest $r) {
        $user=new User;
        $user->email=$r->email;
        $user->password=$r->password;
        $user->full=$r->full;
        $user->address=$r->address;
        $user->phone=$r->phone;
        $user->level=$r->level;
        $user->save();
        return redirect('/admin/user')->with('thongbao','Đã thêm thành công');

    }

    function getEditUser($idUser) {
        $data['user']=User::find($idUser);
        return view('backend.user.edituser',$data);
    }
    function postEditUser($idUser, EditUserRequest $r){
        $user=User::find($idUser);
        $user->email=$r->email;
        $user->password=$r->password;
        $user->full=$r->full;
        $user->address=$r->address;
        $user->phone=$r->phone;
        $user->level=$r->level;
        $user->save();
        return redirect('/admin/user')->with('thongbao','Đã sửa thành công');

    }

    function delUser($idUser){
        User::find($idUser)->delete();
        return redirect()->back()->with('thongbao','Đã xóa thành công');
    }
}
