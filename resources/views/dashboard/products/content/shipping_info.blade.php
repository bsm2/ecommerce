@push('js')
    <script>
        $(document).ready(function() {
            var data=[
                @foreach (App\Models\Country::all() as $country)
                    {
                        "text":"{{ $country->{'name_'.lang()} }}",
                        "children":[
                            @foreach ($country->malls()->get() as $mall)
                                {
                                    "id":"{{ $mall->id }}",
                                    "text":"{{ $mall->{'name_'.lang()} }}",
                                    "selected":'{{App\Models\ProductMall::where('product_id',$product->id)->where('mall_id',$mall->id)->count()>0 ? true:false}}'
                                },
                            @endforeach
                        ],
                    },
                @endforeach
            ]
            $('.mall-select2').select2({
                data,
                theme: "classic",
            });
        });
    </script>
@endpush
<div class="tab-pane fade" id="shipping-info" role="tabpanel" aria-labelledby="nav-contact-tab">
    <h2>@lang('site.shipping_info')</h2>

    <div class="shipping_info">
        <center>
            <h1>choose category</h1>
        </center>
    </div>
    <div  class="other-info" hidden>
        <div class="form-row">
            <div class="form-group col">
                {!! Form::label('color_id', __('site.color')) !!}
                {!! Form::select('color_id',App\Models\Color::pluck('name_'.lang(),'id'),$product->color_id, ['class'=>'form-control','placeholder'=>'....']) !!}
            </div>
            <div class="form-group col">
                {!! Form::label('trade_id', __('site.trademark')) !!}
                {!! Form::select('trade_id',App\Models\Trademark::pluck('name_'.lang(),'id'),$product->trade_id, ['class'=>'form-control','placeholder'=>'....']) !!}
            </div>
            <div class="form-group col">
                {!! Form::label('manu_id', __('site.manufacturers')) !!}
                {!! Form::select('manu_id',App\Models\Manufacturer::pluck('name_'.lang(),'id'),$product->manu_id, ['class'=>'form-control','placeholder'=>'....']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('mall', __('site.malls')) !!}
            <select name="mall[]"  multiple="multiple" style="width: 100%" class="form-control  mall-select2"></select>
        </div>
    </div>
</div>
