@extends('dashboard.index')

@section('content')
    @section('breadcumb')
        <li class="breadcrumb-item active">@lang('site.malls') </li>
    @endsection
    <!-- Main content -->
    <div class="container-fluid ">
        <section class="content ">
            <div class="row ">
                <div class="col-12">
                    <div class="card  ">
                        <div class="card-header">
                            <h3 class="card-title">@lang('site.malls')</h3>
                        </div>
                    <!-- /.card-header -->
                        <div class="card-body table-responsive " >
                            {!! Form::open(['id'=>'form-data','route'=>'dashboard.mall.destroy.all','method'=>'delete']) !!}
                            {!! $dataTable->table(['class'=>'dataTable table table-bordered table-striped  table-hover'],true) !!}
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
{{-- delete model --}}
    <div id="delall" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-body p-0">
                    <div class="card border-0 p-sm-3 p-2 justify-content-center">
                        <div class="empty-records " hidden>
                            <div class=" card-header pb-0 bg-white border-0">
                                <div class="row">
                                    <div class="col ml-auto"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>
                                </div>
                                <p class="font-weight-bold mb-2"> @lang('site.no_chosen_records')</p>
                            </div>

                        </div>
                        <div class="not-empty-records" hidden>
                            <div class="hidden card-header pb-0 bg-white border-0  ">
                                <div class="row">
                                    <div class="col ml-auto"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>
                                </div>
                                <p class="font-weight-bold mb-2">@lang('site.are_you_sure_all')</p>
                                <p><span class="text-muted record-count"></span> @lang('site.records')</p>
                            </div>
                            <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                                <div class="row justify-content-end no-gutters">
                                    <div class="col-auto"><button type="button" class="btn btn-light text-muted" data-dismiss="modal">@lang('site.cancel')</button></div>
                                    <div class="col-auto"><button type="button" class="btn btn-danger px-4 del-all" data-dismiss="modal">@lang('site.delete_all')</button></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')

<script>
</script>
{!! $dataTable->scripts() !!}
@endpush

@endsection