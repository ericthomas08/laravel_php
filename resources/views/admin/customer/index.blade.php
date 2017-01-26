@extends('layouts.admin')

@section('content')
<div class="container">

    <h1>Customer</h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th> First Name </th>
                    <th> Last Name </th>
                    <th> Phone Number </th>
                    <th> Actions </th>
                </tr>
            </thead>
            <tbody>
            @foreach($customer as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->first_name }}</td><td>{{ $item->last_name }}</td><td>{{ $item->phone_number }}</td>
                    <td>
                        <a href="{{ route('admin.customer.view', $item->id) }}" class="btn btn-success btn-xs" title="View Customer"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $customer->render() !!} </div>
    </div>

</div>
@endsection
