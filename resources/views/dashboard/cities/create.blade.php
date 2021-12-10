
@extends('dashboard.index')
@section('content')
    @section('breadcumb')
        <li class="breadcrumb-item active"><a href="{{route('dashboard.city.index')}}">@lang('site.cities')</a></li>
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
                        <div class="card-body table-responsive " >
                            <h4>
                                @include('partials.errors')
                            </h4>
                            {!! Form::open(['route'=>'dashboard.city.store','method'=>'POST','files'=>true]) !!}
                            <div class="form-group">
                                {!! Form::label('name_ar', __('site.ar.name')) !!}
                                {!! Form::text('name_ar',old('name_ar'), ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('name_en', __('site.en.name')) !!}
                                {!! Form::text('name_en',old('name_en'), ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('country_id', __('site.country')) !!}
                                {!! Form::select('country_id',
                                                App\Models\Country::pluck('name_'.lang(),'id')
                                                ,old('country_id'), ['class'=>'form-control','placeholder'=>'choose country']) !!}
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


@push('js')


@endpush

@endsection