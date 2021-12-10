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
        <li class="breadcrumb-item active"><a href="{{route('dashboard.mall.index')}}">@lang('site.malls')</a></li>
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
                            {!! Form::open(['route'=>'dashboard.mall.store','method'=>'POST','files'=>true]) !!}
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
                                    {!! Form::label('contact', __('site.name')) !!}
                                    {!! Form::text('contact',old('contact'), ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('email', __('site.email')) !!}
                                    {!! Form::email('email',old('email'), ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('phone', __('site.phone')) !!}
                                    {!! Form::text('phone',old('phone'), ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('facebook', __('site.facebook')) !!}
                                    {!! Form::text('facebook',old('facebook'), ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('twitter', __('site.twitter')) !!}
                                    {!! Form::text('twitter',old('twitter'), ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('country_id', __('site.country')) !!}
                                    {!! Form::select('country_id',
                                                    App\Models\Country::pluck('name_'.lang(),'id')
                                                    ,old('country_id'), ['class'=>'form-control','placeholder'=>'choose country']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('address', __('site.address')) !!}
                                    {!! Form::text('address',old('address'), ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    <div id="us1" style="width: 100%; height: 400px;"></div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('logo',__('site.logo')) !!}
                                    {!! Form::file('logo',['class'=>'form-control image']) !!}
                                </div>
                                <div class="form-group">
                                    <img src=""  style="width: 100px" class="img-thumbnail logo-preview" alt="">
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