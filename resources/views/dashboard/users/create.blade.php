@extends('dashboard.index')

@section('content')
    @section('breadcumb')
        <li class="breadcrumb-item active"><a href="{{route('dashboard.user.index')}}">@lang('site.users')</a></li>
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
                            {!! Form::open(['route'=>'dashboard.user.store','method'=>'POST']) !!}
                            <div class="form-group">
                                {!! Form::label('name', __('site.name')) !!}
                                {!! Form::text('name',old('name'), ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', __('site.email')) !!}
                                {!! Form::email('email',old('email'), ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('level', __('site.level')) !!}
                                {!! Form::select('level',['user'=>__('site.user'),'vendor'=>__('site.vendor'),'company'=>__('site.company')],old('level'), ['class'=>'form-control','placeholder'=>'choose level']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('password', __('site.password')) !!}
                                {!! Form::password('password', ['class'=>'form-control']) !!}
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