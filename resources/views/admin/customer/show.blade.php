@extends('layouts.admin')

@section('content')
<div class="container">

    <h1>
        Customer {{ $customer->id }}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $customer->id }}</td>
                </tr>
                <tr><th> First Name </th><td> {{ $customer->first_name }} </td></tr><tr><th> Last Name </th><td> {{ $customer->last_name }} </td></tr><tr><th> Phone Number </th><td> {{ $customer->phone_number }} </td></tr>
            </tbody>
        </table>
    </div>

    <h3>Bookings</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th> Date </th>
                <th> Cleaner </th>
            </tr>
            </thead>
            <tbody>
            @foreach($customer->bookings as $item)
                <tr>
                    <td>{!! $item->date !!}</td>
                    <td>{!! $item->cleaner->first_name.' '.$item->cleaner->last_name !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
