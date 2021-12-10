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
        <li class="breadcrumb-item active"><a href="{{route('dashboard.manufacturer.index')}}">@lang('site.manufacturers')</a> </li>
        <li class="breadcrumb-item active">@lang('site.edit') </li>
    @endsection
    <!-- Main content -->
    <div class="container-fluid ">
        <section class="content ">
            <div class="row ">
                <div class="col-12">
                    <div class="card  ">
                        <div class="card-header">
                            <h3 class="card-title ">@lang('site.edit')</h3>
                            
                        </div>
                    <!-- /.card-header -->
                        <div class="card-body table-responsive " >
                            <h4>
                                @include('partials.errors')
                            </h4>
                            {!! Form::open(['route'=>['dashboard.manufacturer.update',$manufacturer->id],'method'=>'PUT','files'=>true]) !!}
                            <div class="form-group">
                                {!! Form::label('name_ar', __('site.ar.name')) !!}
                                {!! Form::text('name_ar',$manufacturer->name_ar, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('name_en', __('site.en.name')) !!}
                                {!! Form::text('name_en',$manufacturer->name_en, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('contact', __('site.name')) !!}
                                {!! Form::text('contact',$manufacturer->contact, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', __('site.email')) !!}
                                {!! Form::email('email',$manufacturer->email, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('phone', __('site.phone')) !!}
                                {!! Form::text('phone',$manufacturer->phone, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('facebook', __('site.facebook')) !!}
                                {!! Form::text('facebook',$manufacturer->facebook, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('twitter', __('site.twitter')) !!}
                                {!! Form::text('twitter',$manufacturer->twitter, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('address', __('site.address')) !!}
                                {!! Form::text('address',$manufacturer->address, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <div id="us1" style="width: 100%; height: 400px;"></div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('logo',__('site.logo')) !!}
                                {!! Form::file('logo',['class'=>'form-control image']) !!}
                            </div>
                            <div class="form-group">
                                <img src="{{Storage::url($manufacturer->logo)}}"  style="width: 100px" class="img-thumbnail logo-preview" alt="">
                            </div>
                            {!! Form::submit(__('site.edit') ,['class'=>'btn btn-primary']) !!}
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

@push('js')
@endpush
@endsection