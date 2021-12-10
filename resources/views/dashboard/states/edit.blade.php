@extends('dashboard.index')

@section('content')
    @section('breadcumb')
        <li class="breadcrumb-item active"><a href="{{route('dashboard.state.index')}}">@lang('site.states')</a> </li>
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
                            {!! Form::open(['route'=>['dashboard.state.update',$state->id],'method'=>'PUT']) !!}
                            <div class="form-group">
                                {!! Form::label('name_ar', __('site.ar.name')) !!}
                                {!! Form::text('name_ar',$state->name_ar, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('name_en', __('site.en.name')) !!}
                                {!! Form::text('name_en',$state->name_en, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('country_id', __('site.country')) !!}
                                {!! Form::select('country_id',
                                                App\Models\Country::pluck('name_'.lang(),'id'),
                                                $state->country_id, ['class'=>'form-control','placeholder'=>'choose country']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('city_id', __('site.city')) !!}
                                <span class="city"></span>
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

    <script type="text/javascript">
    
        $(document).ready(function () {
            @if($state->country_id)
            
                $.ajax({
                        url:'{{ url('dashboard/state/create') }}',
                        type:'get',
                        dataType:'html',
                        data:{country_id:'{{ $state->country_id }}',select:'{{ $state->city_id }}'},
                        success:function(data){
                            
                            $('.city').html(data);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            console.log(textStatus);
                            console.log(errorThrown);
                        }
                    });
            @endif
    
            $(document).on('change beforeunload','.country-id',function () {
                var country=$('.country-id option:selected').val();
                //console.log(country);
                if (country > 0) {
                    $.ajax({
                        url:'{{ url('dashboard/state/create') }}',
                        type:'get',
                        dataType:'html',
                        data:{country_id:country,select:''},
                        success:function(data){
                            $('.city').html(data);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            console.log(textStatus);
                            console.log(errorThrown);
                        }
                    });
                }else{
                    $('.city').html('');
                }
            })
        })
    
    </script>
    
    
@endpush
@endsection