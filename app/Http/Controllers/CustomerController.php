<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Customer;
use Illuminate\Http\Request;
use Session, Redirect, View;

class CustomerController extends Controller
{

    public function index()
    {
        if (Session::has('customer_id')) {
            return Redirect::route('customer.booking');
        } else {
            return Redirect::route('customer.auth.login');
        }
    }

    public function login() {
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
            return View::make('customer.auth.login')->with($param);
        } else {
            return View::make('customer.auth.login');
        }
    }

    public function create() {
        return view('customer.create');
    }

    public function doLogin(Request $request) {
        $phone = $request->get('phone_number');
        $password = $request->get('password');

        $customer = Customer::whereRaw('phone_number = ? and password = ?', [$phone, md5($password)])->get();

        if (count($customer) != 0) {
            Session::set('customer_id', $customer[0]->id);
            return Redirect::route('customer.booking');
        } else {
            $alert['msg'] = 'Invalid phone number and password';
            $alert['type'] = 'danger';
            return Redirect::route('customer.auth.login')->with('alert', $alert);
        }
    }

    public function doRegister(Request $request)
    {

        $customer = new Customer();
        $customer->first_name = $request->get('first_name');
        $customer->last_name = $request->get('last_name');
        $customer->phone_number = $request->get('phone_number');
        $customer->password = md5($request->get('password'));
        $customer->save();


        Session::flash('flash_message', 'Customer added!');

        return Redirect::route('customer.booking');
    }

    public function doLogout() {
        Session::forget('customer_id');
        return Redirect::route('customer.auth.login');
    }
}
