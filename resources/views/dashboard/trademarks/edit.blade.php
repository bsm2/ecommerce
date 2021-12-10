@extends('dashboard.index')

@section('content')
    @section('breadcumb')
        <li class="breadcrumb-item active"><a href="{{route('dashboard.trademark.index')}}">@lang('site.trademarks')</a> </li>
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
                            {!! Form::open(['route'=>['dashboard.trademark.update',$trademark->id],'method'=>'PUT','files'=>true]) !!}
                            <div class="form-group">
                                {!! Form::label('name_ar', __('site.ar.name')) !!}
                                {!! Form::text('name_ar',$trademark->name_ar, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('name_en', __('site.en.name')) !!}
                                {!! Form::text('name_en',$trademark->name_en, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('logo',__('site.logo')) !!}
                                {!! Form::file('logo',['class'=>'form-control image']) !!}
                            </div>
                            <div class="form-group">
                                <img src="{{Storage::url($trademark->logo)}}"  style="width: 100px" class="img-thumbnail logo-preview" alt="">
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