@extends('layouts.admin')

@section('content')
<div class="container">

    <h1>Cities <a href="{{ route('admin.city.create') }}" class="btn btn-primary btn-xs" title="Add New Cleaner"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th> Name </th>
                    <th> Actions </th>
                </tr>
            </thead>
            <tbody>
            @foreach($cities as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'route' => ['admin.city.delete', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Cleaner" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Cleaner',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $cities->render() !!} </div>
    </div>

</div>
@endsection
