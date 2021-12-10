@push('js')
    <script type="text/javascript">
      $(document).ready(function(){
          $('.datepicker').datepicker({
            language:'{{ lang() }}',
            rtl:'{{ direction() }}',
            autoclose:false,
            format:'yyyy-mm-dd',
            todayBtn:'linked',
            todayHighlight:true,
            clearBtn:true
          });
      });
      $(document).on('change','.status',function(){
        var status =$('.status option:selected').val();
        console.log(status)
        status=='refused' ? $('.reason').attr("hidden",false):$('.reason').attr("hidden",true);
      });
    </script>
@endpush  
  <div class="tab-pane fade" id="product-setting" role="tabpanel" aria-labelledby="nav-profile-tab">
    <h2>@lang('site.product_setting')</h2>
    <div class="form-group">
      {!! Form::label('price', __('site.price')) !!}
      {!! Form::text('price',$product->price, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('stock', __('site.stock')) !!}
      {!! Form::text('stock',$product->stock, ['class'=>'form-control']) !!}
    </div>
    <div class="form-row">
      <div class="form-group col ">
        {!! Form::label('start_at', __('site.start_at')) !!}
        {!! Form::text('start_at',$product->start_at, ['class'=>'form-control datepicker']) !!}
      </div>
      <div class="form-group col">
        {!! Form::label('end_at', __('site.end_at')) !!}
        {!! Form::text('end_at',$product->end_at, ['class'=>'form-control datepicker']) !!}
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('offer_price', __('site.offer_price')) !!}
      {!! Form::text('offer_price',$product->offer_price, ['class'=>'form-control']) !!}
    </div>
    <form>
      <div class="form-row">
        <div class="form-group col ">
          {!! Form::label('offer_start_at', __('site.offer_start_at')) !!}
          {!! Form::text('offer_start_at',$product->offer_start_at, ['class'=>'form-control datepicker']) !!}
        </div>
        <div class="form-group col">
          {!! Form::label('offer_end_at', __('site.offer_end_at')) !!}
          {!! Form::text('offer_end_at',$product->offer_start_at, ['class'=>'form-control datepicker']) !!}
        </div>
      </div>
    </form>
    <div class="clearfix"></div>
    <div class="form-group">
      {!! Form::label('status', __('site.status')) !!}
      {!! Form::select('status',['pending'=>__('site.pending'),'refused'=>__('site.refused'),'active'=>__('site.active')],$product->status, ['class'=>'form-control status']) !!}
    </div>
    <div class="form-group reason" hidden>
      {!! Form::label('reason', __('site.reason')) !!}
      {!! Form::textarea('reason',$product->reason, ['class'=>'form-control']) !!}
    </div>
</div>