@extends('dashboard.index')
@section('content')
@push('js')
    <script type="text/javascript">
        $(document).ready(function(){

            $('#jstree').jstree({
                "core" : {
                    'data' :{!! get_cat(old('category_id')) !!},
                },
                "checkbox" : {
                    "keep_selected_style" : false
                },
                "plugins" : [ "wholerow"]
            });

            $('#jstree').on('changed.jstree',function (e,data) {
                var j=data.selected;
                var r=[];
                for (let i =0; i < j.length; i++) {
                    r.push(data.instance.get_node(data.selected[i]).id);
                }
                $('.category-id').val(r.join(','));
                if (r.join(',') !== '') {
                    $('.category-id').val(r.join(','));
                }
            })

        });
    </script>
@endpush

@section('breadcumb')
    <li class="breadcrumb-item active"><a href="{{route('dashboard.size.index')}}">@lang('site.sizes')</a></li>
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
                            {!! Form::open(['route'=>'dashboard.size.store','method'=>'POST','files'=>true]) !!}
                            <div class="form-group">
                                {!! Form::label('name_ar', __('site.ar.name')) !!}
                                {!! Form::text('name_ar',old('name_ar'), ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('name_en', __('site.en.name')) !!}
                                {!! Form::text('name_en',old('name_en'), ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('is_public', __('site.public')) !!}
                                {!! Form::select('is_public',
                                                ['yes'=>__('site.yes'),'no'=>__('site.no')]
                                                ,old('is_public'), ['class'=>'form-control','placeholder'=>'choose...']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('category', __('site.category')) !!}
                                <div class="clearfix"></div>
                                <input type="hidden" name="category_id" class="category-id" value="{{old('category_id')}}">
                                <div id="jstree"></div>
                                <div class="clearfix"></div>
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