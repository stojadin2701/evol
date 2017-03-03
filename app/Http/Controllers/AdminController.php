<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\User;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function admin()
    {
        $users = User::all();
        return view('admin/admin', compact('users'));
    }

    public function search()
    {
        $keywords = Input::get('keywords');
        $users = User::where('username', 'LIKE', '%'.$keywords.'%')->where('privilege', '<>', 1)->get();
        return view('admin/searchedUsers', compact('users'));
    }

    public function checkModStatus()
    {
        $username = Input::get('username');
        $user = User::where('username', $username)->first();
        return $user->isMod() ? 'y' : 'n';
    }

    public function changePrivileges()
    {
        $username = Input::get('username');
        $action = Input::get('action');
        $user = User::where('username', $username)->first();
        if ($action == "add") {
            $user->setModPrivileges();
        } else {
            $user->removeModPrivileges();
        }
        $user->save();
    }

}
