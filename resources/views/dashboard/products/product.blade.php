@extends('dashboard.index')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
            $(document).on('click','.save-continue',function() {
                var data = $('#product-form').serialize();
                console.log(data);
                $.ajax({
                    url:"{{ route('dashboard.product.update',$product->id) }}",
                    type:'post',
                    dataType:'json',
                    data:data,
                    beforeSend:function(){
                        $('.loading-save-continue').attr('hidden',false);
                        $('.validate-messages').html('');
                        $('.error-messages').attr('hidden',true);
                        $('.success-messages').html('').attr('hidden',true);
                    },success:function(data){
                        console.log(data);
                        $('.loading-save-continue').attr('hidden',true);
                        $('.success-messages').html('<h2>'+data.message+'</h2>').attr('hidden',false).delay(5000).fadeOut();
                    },error:function(response){
                        var errors_list='';
                        $('.loading-save-continue').attr('hidden',true);
                        $.each(response.responseJSON.errors, function (index, value) { 
                            errors_list += '<li>'+value+'</li>';
                        });
                        $('.validate-messages').html(errors_list);
                        $('.error-messages').attr('hidden',false);
                    }
                    
                });
                return false;
                
            });
        });


    </script>
@endpush


@section('breadcumb')
    <li class="breadcrumb-item active"><a href="{{route('dashboard.product.index')}}">@lang('site.products')</a></li>
    <li class="breadcrumb-item active">{{$title}} </li>
@endsection
    <!-- Main content -->
    <div class="container-fluid ">
        <section class="content ">
            <div class="row ">
                <div class="col-12">
                    <div class="card  ">
                        <div class="card-header">
                            <h3 class="card-title">{{$title}}</h3>
                            
                        </div>
                    <!-- /.card-header -->
                        <div class="card-body " >
                            {!! Form::open(['route'=>'dashboard.product.store','id'=>'product-form','method'=>'PUT','files'=>true]) !!}
                                <a href="#"><div class="btn btn-primary save">@lang('site.save') <i class="fa fa-save"></i></div></a>
                                <a href="#"><div class="btn btn-success save-continue">@lang('site.save_continue') <i class="far fa-save"></i>  <i class="fas fa-spin fa-spinner loading-save-continue" hidden></i></div></a>
                                <a href="#"><div class="btn btn-info copy">@lang('site.copy') <i class="fa fa-copy"></i></div></a>
                                <a href="#"><div class="btn btn-danger delete"  data-toggle="modal" data-target="#del-this-{{$product->id}}">@lang('site.delete') <i class="fa fa-trash"></i></div></a>
                                
                                <div class="form-group">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#product-info" role="tab" aria-controls="nav-home" aria-selected="true">@lang('site.product_info') <i class="fas fa-info-circle"></i></a>
                                            <a class="nav-link" id="nav-home-tab" data-toggle="tab" href="#product-media" role="tab" aria-controls="nav-home" aria-selected="true">@lang('site.media') <i class="fa fa-images"></i></a>
                                            <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#product-setting" role="tab" aria-controls="nav-profile" aria-selected="false">@lang('site.product_setting') <i class="fa fa-cog"></i></a>
                                            <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#category" role="tab" aria-controls="nav-profile" aria-selected="false">@lang('site.category') <i class="fa fa-list"></i></a>
                                            <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#shipping-info" role="tab" aria-controls="nav-contact" aria-selected="false">@lang('site.shipping_info') <i class="fas fa-truck"></i></a>
                                            <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#other-data" role="tab" aria-controls="nav-contact" aria-selected="false">@lang('site.other_data') <i class="fas fa-question-circle"></i></a>
                                        </div>
                                    </nav>
                                    <div class="alert alert-danger error-messages" hidden>
                                        <ul class="validate-messages">
                                        </ul>
                                    </div>
                                    <div class="alert alert-success success-messages" hidden></div>
                                    <div class="tab-content" id="nav-tabContent">
                                        @include('dashboard.products.content.product_info')
                                        @include('dashboard.products.content.product_media')
                                        @include('dashboard.products.content.product_setting')
                                        @include('dashboard.products.content.category')
                                        @include('dashboard.products.content.shipping_info')
                                        @include('dashboard.products.content.other_data')
                                    </div>
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
        <div id="del-this-{{$product->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0">
                    {!! Form::open(['route'=>['dashboard.product.destroy',$product->id],'method'=>'delete']) !!}
                        <div class="modal-body p-0">
                            <div class="card border-0 p-sm-3 p-2 justify-content-center">
                                <div class="not-empty-records">
                                    <div class=" card-header pb-0 bg-white border-0  ">
                                        <div class="row">
                                            <div class="col ml-auto"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>
                                        </div>
                                        <p class="font-weight-bold mb-2">@lang('site.are_you_sure') {{ $product->id }}</p>
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