@extends('dashboard.index')
@section('content')
@push('js')
    <script type="text/javascript">
        $(document).ready(function(){

            $('#jstree').jstree({
                "core" : {
                    'data' :{!! get_cat($category->parent_id,$category->id) !!},
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
                $('.parent-id').val(r.join(','));
            })

        });
    </script>
@endpush
@section('breadcumb')
    <li class="breadcrumb-item active"><a href="{{route('dashboard.category.index')}}">@lang('site.categories')</a></li>
    <li class="breadcrumb-item active">@lang('site.edit') </li>
@endsection

    <!-- Main content -->
    <div class="container-fluid ">
        <section class="content ">
            <div class="row ">
                <div class="col-12">
                    <div class="card  ">
                        <div class="card-header">
                            <h3 class="card-title">@lang('site.edit')</h3>
                            
                        </div>
                    <!-- /.card-header -->
                        <div class="card-body table-responsive " >
                            <h4>
                                @include('partials.errors')
                            </h4>
                            {!! Form::open(['route'=>['dashboard.category.update',$category->id],'method'=>'PUT','files'=>true]) !!}
                            <div class="form-group">
                                {!! Form::label('name_ar', __('site.ar.name')) !!}
                                {!! Form::text('name_ar',$category->name_ar, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('name_en', __('site.en.name')) !!}
                                {!! Form::text('name_en',$category->name_en, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('category', __('site.category')) !!}
                                <div class="clearfix"></div>
                                <input type="hidden" name="parent_id" class="parent-id" value="{{old('parent_id')}}">
                                <div id="jstree"></div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('keyword', __('site.keywords')) !!}
                                {!! Form::text('keyword',$category->keyword, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', __('site.description')) !!}
                                {!! Form::text('description',$category->description, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('icon',__('site.icon')) !!}
                                {!! Form::file('icon',['class'=>'form-control image']) !!}
                            </div>
                            <div class="form-group">
                                <img src="{{ Storage::url( $category->icon ) }}"  style="width: 100px" class="img-thumbnail icon-preview" alt="">
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

@endsection