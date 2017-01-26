@extends('layouts.admin')

@section('content')
<div class="container">

    <h1>
        Cleaner {{ $cleaner->id }}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $cleaner->id }}</td>
                </tr>
                <tr><th> First Name </th><td> {{ $cleaner->first_name }} </td></tr><tr><th> Last Name </th><td> {{ $cleaner->last_name }} </td></tr><tr><th> Quality Score </th><td> {{ $cleaner->quality_score }} </td></tr>
            </tbody>
        </table>
    </div>

    <h3>Bookings</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th> Date </th>
                <th> Customer Name </th>
                <th> Phone Number </th>
            </tr>
            </thead>
            <tbody>
            @foreach($cleaner->bookings as $item)
                <tr>
                    <td>{!! $item->date !!}</td>
                    <td>{!! $item->customer->first_name.' '.$item->customer->last_name !!}</td>
                    <td>{!! $item->customer->phone_number !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
