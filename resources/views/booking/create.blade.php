@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Create New Booking</h1>
        <hr/>

        @if (isset($alert))
        <div class="alert alert-{!! $alert['type'] !!} alert-dismissibl fade in">
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">close</span>
            </button>
            <p>
                {!! $alert['msg'] !!}
            </p>
        </div>
        @endif

        {!! Form::open(['route' => 'customer.booking.store', 'class' => 'form-horizontal', 'files' => true]) !!}


        <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
            {!! Form::label('date', 'Date', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::date('date', null, ['class' => 'form-control']) !!}
                {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('city_id', 'City', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('city_id'
                   , $cities->pluck('name', 'id')->all()
                   , null
                   , array('class' => 'form-control', 'id' => 'select_city')) !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('cleaner_id') ? 'has-error' : ''}}">
            {!! Form::label('cleaner_id', 'Cleaner', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6" id="cleaner-box">
                <select class="form-control" name="cleaner_id">
                    @foreach($cities[0]->cleaners as $cleaner)
                        <option value="{!! $cleaner->cleaner_id !!}">{!! $cleaner->cleaner->first_name.' '.$cleaner->cleaner->last_name !!}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
        {!! Form::close() !!}

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {{--Select Boxs for Sub-Categories --}}
        @foreach ($cities as $city)
            <select class="form-control hidden" id="select-cleaner-{!! $city->id !!}" name="cleaner_id">
                @foreach($city->cleaners as $cleaner)
                    <option value="{!! $cleaner->cleaner_id !!}">{!! $cleaner->cleaner->first_name.' '.$cleaner->cleaner->last_name !!}</option>
                @endforeach
            </select>
        @endforeach
        {{----}}

    </div>
@endsection

@section('custom-scripts')
    <script type="text/javascript">
        $('#select_city').change(function() {
            var val = $('#select_city').val();
            $('div#cleaner-box').empty();
            var objClone = $("#select-cleaner-" + val).clone().removeClass('hidden');
            objClone.attr("id", "language_item");
            $('div#cleaner-box').eq(0).append(objClone);
        });
    </script>
@endsection