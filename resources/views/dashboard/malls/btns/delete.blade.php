
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del-this">
    <i class="fa fa-trash"></i>
</button>
{{-- delete model --}}
<div id="del-this" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            {!! Form::open(['route'=>['dashboard.mall.destroy',$id],'method'=>'delete']) !!}
                <div class="modal-body p-0">
                    <div class="card border-0 p-sm-3 p-2 justify-content-center">
                        <div class="not-empty-records">
                            <div class=" card-header pb-0 bg-white border-0  ">
                                <div class="row">
                                    <div class="col ml-auto"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>
                                </div>
                                <p class="font-weight-bold mb-2">@lang('site.are_you_sure') {{ lang()=='ar' ?$name_ar:$name_en}}</p>
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
