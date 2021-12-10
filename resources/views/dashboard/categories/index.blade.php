@extends('dashboard.index')
@section('content')
@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            
            $('#jstree').jstree({
                "core" : {
                    'data' : {!! get_cat() !!},
                    "themes" : {
                            "variant" : "large"
                        }
                },
                "checkbox" : {
                    "keep_selected_style" : false
                },
                "plugins" : [ "wholerow" ]
            });

            $('#jstree').on('changed.jstree',function (e,data) {
                var j=data.selected;
                var r=[];
                for (let i =0; i < j.length; i++) {
                    r.push(data.instance.get_node(data.selected[i]).id);
                }
                $('.parent-id').val(r.join(','));

                if (r.join(',') !== '') {
                    $('.show-btn').attr("hidden",false);
                    $('.edit-cat').attr('href','{{ url('dashboard/category')}}/'+r.join(',')+'/edit')
                    $('#delete-cat-form').attr('action','{{ url('dashboard/category')}}/'+r.join(','))
                }else{
                    $('.show-btn').attr("hidden",true);
                }
            })

        })
    </script>
@endpush
@section('breadcumb')
    <li class="breadcrumb-item active">@lang('site.categories') </li>
@endsection
    <!-- Main content -->
    <div class="container-fluid ">
        <section class="content ">
            <div class="row ">
                <div class="col-12">
                    <div class="card  ">
                        <div class="card-header">
                            <h3 class="card-title">@lang('site.categories')</h3>
                        </div>
                    <!-- /.card-header -->
                        <div class="card-body " >
                                <a href="" class="edit-cat"><div class="btn btn-info  show-btn" hidden><i class="fa fa-edit"></i></div></a>
                                {{-- <a href="" class="del-cat"><div class="btn btn-danger del  show-btn" hidden><i class="fa fa-trash"></i></div></a> --}}
                                <button type="button" class="btn btn-danger show-btn" data-toggle="modal" data-target="#del-this" hidden>
                                    <i class="fa fa-trash"></i>
                                </button>

                            <div>

                                <input type="hidden" name="parent_id" class="parent-id" value="{{old('parent_id')}}">
                                <div id="jstree"></div>

                            </div>

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

{{-- delete model --}}
<div id="del-this" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            {!! Form::open(['route'=>['dashboard.category.destroy','1'],'method'=>'delete','id'=>'delete-cat-form']) !!}
                <div class="modal-body p-0">
                    <div class="card border-0 p-sm-3 p-2 justify-content-center">
                        <div class="not-empty-records">
                            <div class=" card-header pb-0 bg-white border-0  ">
                                <div class="row">
                                    <div class="col ml-auto"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>
                                </div>
                                <p class="font-weight-bold mb-2 cat-name">@lang('site.are_you_sure') </p>
                            </div>
                            <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                                <div class="row justify-content-end no-gutters">
                                    <div class="col-auto"><button type="button" class="btn btn-light text-muted" data-dismiss="modal">@lang('site.cancel')</button></div>
                                    {!! Form::submit(__('site.delete'), ['class'=>'col-auto btn btn-danger px-4']) !!}
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


@endsection