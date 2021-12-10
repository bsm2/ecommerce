@extends('dashboard.index')
@section('content')
    @section('breadcumb')
        <li class="breadcrumb-item active">@lang('site.settings') </li>
    @endsection
<div class="card">
    <div class="card-header">
        <h3 class="box-title">{{ $title }}</h3>
    </div>
    <!-- /.box-header -->
    <div class="card-body">
        <h4>
            @include('partials.errors')
        </h4>
        {!! Form::open(['route'=>['dashboard.settings.update',$settings->id],'method'=>'PUT','files'=>true]) !!}
        <div class="form-group">
        {!! Form::label('sitename_ar',__('site.sitename_ar')) !!}
        {!! Form::text('sitename_ar',$settings->sitename_ar,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
        {!! Form::label('sitename_en',__('site.sitename_en')) !!}
        {!! Form::text('sitename_en',$settings->sitename_en,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
        {!! Form::label('email',__('site.email')) !!}
        {!! Form::email('email',$settings->email,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
        {!! Form::label('logo',__('site.logo')) !!}
        {!! Form::file('logo',['class'=>'form-control image']) !!}
        </div>
        <div class="form-group">
            <img src="{{ Storage::url( $settings->logo) }}"  style="width: 100px" class="img-thumbnail logo-preview" alt="">
        </div>
        <div class="form-group">
        {!! Form::label('icon',__('site.icon')) !!}
        {!! Form::file('icon',['class'=>'form-control image']) !!}
        </div>
        <div class="form-group">
            <img src="{{ Storage::url( $settings->icon) }}"  style="width: 100px" class="img-thumbnail icon-preview" alt="">
        </div>
        <div class="form-group">
        {!! Form::label('description',__('site.description')) !!}
        {!! Form::textarea('description',$settings->description,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
        {!! Form::label('keywords',__('site.keywords')) !!}
        {!! Form::textarea('keywords',$settings->keywords,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
        {!! Form::label('main_lang',__('site.main_lang')) !!}
        {!! Form::select('main_lang',['ar'=>__('site.arabic'),'en'=>__('site.english')],$settings->main_lang,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
        {!! Form::label('status',__('site.status')) !!}
        {!! Form::select('status',['open'=>__('site.open'),'close'=>__('site.closed')],$settings->status,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
        {!! Form::label('message_maintenance',__('site.message_maintenance')) !!}
        {!! Form::textarea('message_maintenance',$settings->message_maintenance,['class'=>'form-control']) !!}
        </div>
        {!! Form::submit(__('site.save'),['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection