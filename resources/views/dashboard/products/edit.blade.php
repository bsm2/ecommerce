@extends('dashboard.index')
@section('content')


@section('breadcumb')
    <li class="breadcrumb-item active"><a href="{{route('dashboard.product.index')}}">@lang('site.products')</a> </li>
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
                            {!! Form::open(['route'=>['dashboard.product.update',$product->id],'method'=>'PUT']) !!}
                            <div class="form-group">
                                {!! Form::label('name_ar', __('site.ar.name')) !!}
                                {!! Form::text('name_ar',$product->title, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('name_en', __('site.en.name')) !!}
                                {!! Form::text('name_en',$product->content, ['class'=>'form-control']) !!}
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