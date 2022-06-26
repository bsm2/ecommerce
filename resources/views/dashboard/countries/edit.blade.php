@extends('dashboard.index')

@section('content')
    @section('breadcumb')
        <li class="breadcrumb-item active"><a href="{{route('dashboard.country.index')}}">@lang('site.countries')</a> </li>
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
                            {{ BsForm::resource('countries')->putModel($country, route('dashboard.country.update', $country), ['files' => true,'data-parsley-validate']) }}
                            <div class="form-group">
                                @bsMultilangualFormTabs
                                <div >
                                    {{ BsForm::text('name')->required()->attribute(['data-parsley-maxlength' => '191', 'data-parsley-minlength' => '3'])->label(__('countries.attributes.name')) }}
                                </div>
                                @endBsMultilangualFormTabs
                            </div>
                            <div class="form-group">
                                {!! Form::label('code', __('site.code')) !!}
                                {!! Form::text('code',$country->code, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('mob', __('site.mob')) !!}
                                {!! Form::text('mob',$country->mob, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('currency', __('site.currency')) !!}
                                {!! Form::text('currency',$country->currency, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('logo',__('site.flag')) !!}
                                {!! Form::file('logo',['class'=>'form-control image']) !!}
                            </div>
                            <div class="form-group">
                                <img src="{{Storage::url($country->logo)}}"  style="width: 100px" class="img-thumbnail logo-preview" alt="">
                            </div>
                            {!! Form::submit(__('site.edit') ,['class'=>'btn btn-primary']) !!}
                            {{ BsForm::close() }}
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