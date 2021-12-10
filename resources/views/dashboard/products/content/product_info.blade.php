<div class="tab-pane fade show active" id="product-info" role="tabpanel" aria-labelledby="nav-home-tab">
    <h2>@lang('site.product_info')</h2>
    <div class="form-group">
        {!! Form::label('title', __('site.title')) !!}
        {!! Form::text('title',$product->title, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('content', __('site.content')) !!}
        {!! Form::textarea('content',$product->content, ['class'=>'form-control']) !!}
    </div>
</div>
