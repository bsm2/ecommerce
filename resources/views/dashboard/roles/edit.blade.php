@extends('dashboard.index')

@section('content')
    @section('breadcumb')
        <li class="breadcrumb-item active"><a href="{{route('dashboard.role.index')}}">@lang('site.roles')</a> </li>
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
                            {!! Form::open(['route'=>['dashboard.role.update',$role->id],'method'=>'PUT','files'=>true]) !!}
                            <div class="form-group">
                                {!! Form::label('name', __('site.name')) !!}
                                {!! Form::text('name',$role->name, ['class'=>'form-control']) !!}
                            </div>
                            {{-- <div class="form-group">
                                {!! Form::label('name_en', __('site.en.name')) !!}
                                {!! Form::text('name_en',$role->name_en, ['class'=>'form-control']) !!}
                            </div> --}}
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