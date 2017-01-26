<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Booking;
use App\City;
use Illuminate\Http\Request;
use Session, Redirect, View, Mail;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $booking = Booking::paginate(25);

        return view('booking.index', compact('booking'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $param['cities'] = City::get();
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }

        return View::make('booking.create')->with($param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();

        $customerId = Session::get('customer_id');
        $cleanerId = $request->get('cleaner_id');
        $date = $request->get('date');

        if (Booking::where('cleaner_id', $cleanerId)->where('date', $date)->get()->count()) {
            $alert['msg'] = 'Cleaner is already reserved!';
            $alert['type'] = 'danger';
            return Redirect::route('customer.booking.create')->with('alert', $alert);
        }

        $booking = new Booking();
        $booking->date = $date;
        $booking->customer_id = $customerId;
        $booking->cleaner_id = $cleanerId;
        $booking->save();

        Mail::send('emails.booking', ['booking' => $booking], function ($m) use ($booking) {
            $m->from('noreply@homestead.com', 'Homestead');

            $m->to($booking->cleaner->email, $booking->cleaner->first_name.' '. $booking->cleaner->last_name)->subject('Booking information');
        });

        Session::flash('flash_message', 'Booking added!');

        return Redirect::route('customer.booking');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $booking = Booking::findOrFail($id);

        return view('booking.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);

        return view('booking.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $booking = Booking::findOrFail($id);
        $booking->update($requestData);

        Session::flash('flash_message', 'Booking updated!');

        return redirect('booking');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Booking::destroy($id);

        Session::flash('flash_message', 'Booking deleted!');

        return Redirect::route('customer.booking');
    }
}
