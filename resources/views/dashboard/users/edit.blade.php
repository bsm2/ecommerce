@extends('dashboard.index')

@section('content')
    @section('breadcumb')
        <li class="breadcrumb-item active"><a href="{{route('dashboard.user.index')}}">@lang('site.users')</a> </li>
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
                            {!! Form::open(['route'=>['dashboard.user.update',$user->id],'method'=>'PUT']) !!}
                            <div class="form-group">
                                {!! Form::label('name', __('site.name')) !!}
                                {!! Form::text('name',$user->name, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', __('site.email')) !!}
                                {!! Form::email('email',$user->email, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('level', __('site.level')) !!}
                                {!! Form::select('level',['user'=>__('site.user'),'vendor'=>__('site.vendor'),'company'=>__('site.company')],$user->level, ['class'=>'form-control','placeholder'=>'choose level']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('password', __('site.password')) !!}
                                {!! Form::password('password', ['class'=>'form-control']) !!}
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