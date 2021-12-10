@extends('dashboard.index')

@section('content')
    @section('breadcumb')
        <li class="breadcrumb-item active"><a href="{{route('dashboard.role.index')}}">@lang('site.roles')</a></li>
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
                            {!! Form::open(['route'=>'dashboard.role.store','method'=>'POST','files'=>true]) !!}
                            <div class="form-group">
                                {!! Form::label('name', __('site.name')) !!}
                                {!! Form::text('name',old('name'), ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('permissions', __('site.permissions')) !!}
                                    {{-- <nav>
                                        @php
                                            $models = ['role', 'category', 'product'];
                                            $actions = ['create', 'read', 'edit', 'delete'];
                                        @endphp
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            @foreach ($models as $index=>$model)
                                            <a class="nav-link {{ $index == 0 ? 'active' : '' }}" id="nav-contact-tab" data-toggle="tab" href="#{{ $model }}" role="tab" aria-controls="nav-contact" aria-selected="false">@lang('site.'.$model)</a>
                                                <li class=""><a href="" data-toggle="tab"></a></li>
                                            @endforeach
                                        
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        @foreach ($models as $index=>$model)
                                            
                                            <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="{{ $model }}" role="tabpanel" aria-labelledby="nav-contact-tab">
                                                @foreach ($actions as $action)
                                                        <label>
                                                            {{ Form::checkbox('permissions[]', $model.'-'.$action , false, array('class' => '')) }}
                                                            {{ __('site.'.$action) }}
                                                        </label>
                                                @endforeach
                                            </div>
                                        @endforeach   

                                    </div> --}}
                                    <br/>
                                    @foreach($permissions as $permission)
                                        <label>{{ Form::checkbox('permissions[]', $permission->id, false, array('class' => 'name')) }}
                                        {{ $permission->name }}</label>
                                    <br/>
                                    @endforeach
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