
<div class="form-row">
    <div class="form-group col ">
        {!! Form::label('size', __('site.size')) !!}
        {!! Form::text('size',$product->size, ['class'=>'form-control datepicker']) !!}
    </div>
    <div class="form-group col">
        {!! Form::label('size_id', __('site.size_id')) !!}
        {!! Form::select('size_id',$sizes,$product->size_id, ['class'=>'form-control size_id' ,'placeholder'=>'....']) !!}
    </div>
</div>

<div class="form-row">
    <div class="form-group col ">
        {!! Form::label('weight', __('site.weight')) !!}
        {!! Form::text('weight',$product->weight, ['class'=>'form-control datepicker']) !!}
    </div>
    <div class="form-group col">
        {!! Form::label('weight_id', __('site.weight_id')) !!}
        {!! Form::select('weight_id',$weights,$product->weight_id, ['class'=>'form-control size_id','placeholder'=>'....']) !!}
    </div>
</div>
