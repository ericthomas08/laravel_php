<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Admin as AdminModel;
use Illuminate\Http\Request;
use Session, Redirect, View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (Session::has('admin_id')) {
            return Redirect::route('admin.city');
        } else {
            return Redirect::route('admin.auth.login');
        }
    }

    public function login() {
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
            return View::make('admin.auth.login')->with($param);
        } else {
            return View::make('admin.auth.login');
        }
    }

    public function doLogin(Request $request) {
        $email = $request->get('email');
        $password = $request->get('password');

        $admin = AdminModel::whereRaw('email = ? and secure_key = ?', [$email, md5('abcdefgh'.$password)])->get();

        if (count($admin) != 0) {
            Session::set('admin_id', 1);
            return Redirect::route('admin.city');
        } else {
            $alert['msg'] = 'Invalid email and password';
            $alert['type'] = 'danger';
            return Redirect::route('admin.auth.login')->with('alert', $alert);
        }
    }

    public function doLogout() {
        Session::forget('admin_id');
        return Redirect::route('admin.auth.login');
    }

}
