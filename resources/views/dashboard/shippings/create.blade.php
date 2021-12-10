@extends('dashboard.index')

@section('content')

@push('js')

    <!-- Location picker -->
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
    <script src="{{ asset('dashboard_files/dist/js/locationpicker.jquery.js')}}"></script>
    <script type="text/javascript" >
        $('#us1').locationpicker({
                            location: {
                                latitude: 46.15242437752303,
                                longitude: 2.7470703125
                            },
                            radius: 300,
                            markerIcon: 'http://www.iconsdb.com/icons/preview/tropical-blue/map-marker-2-xl.png',
                            inputBinding: {
                            latitudeInput: $('#lat'),
                            longitudeInput: $('#lng'),
                            radiusInput: $('#us2-radius'),
                            locationNameInput: $('#us2-address')
                            }

                        });
                    
    </script>

@endpush

    @section('breadcumb')
        <li class="breadcrumb-item active"><a href="{{route('dashboard.shipping.index')}}">@lang('site.shippings')</a></li>
        <li class="breadcrumb-item active">@lang('site.create') </li>
    @endsection
    <!-- Main content -->
    <div class="container-fluid ">
        <section class="content ">
            <div class="row ">
                <div class="col-12">
                    <div class="card  ">
                        <div class="card-header">
                            <h3 class="card-title">@lang('site.create')</h3>
                            
                        </div>
                    <!-- /.card-header -->
                        <div class="card-body " >
                            <h4>
                                @include('partials.errors')
                            </h4>
                            {!! Form::open(['route'=>'dashboard.shipping.store','method'=>'POST','files'=>true]) !!}
                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="lng" id="lng">
                                <div class="form-group">
                                    {!! Form::label('name_ar', __('site.ar.name')) !!}
                                    {!! Form::text('name_ar',old('name_ar'), ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('name_en', __('site.en.name')) !!}
                                    {!! Form::text('name_en',old('name_en'), ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('address', __('site.address')) !!}
                                    {!! Form::text('address',old('address'), ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('user_id', __('site.company')) !!}
                                    {!! Form::select('user_id',\App\Models\User::where('level','company')->pluck('name','id'),old('user_id'), ['class'=>'form-control','placeholder'=>'choose company']) !!}
                                </div>
                                <div class="form-group">
                                    <div id="us1" style="width: 100%; height: 400px;"></div>
                                </div>
                            {!! Form::submit(__('site.create') ,['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </div>
                    <!-- /.card-body -->
                    </div>
                <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        <section >
    </div><!-- /.container-fluid -->


@endsection