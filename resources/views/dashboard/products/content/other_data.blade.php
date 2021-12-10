@push('js')
    <script type="text/javascript">
        var i=1;
        $(document).on('click','.add-input',function(){
            var max =10;
            var input_view =`<div class="form-row">
                                <div class="form-group col ">
                                    {!! Form::label('input_key', __('site.key')) !!}
                                    {!! Form::text('other_data[${i}][input_key]','', ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group col">
                                    {!! Form::label('input_value', __('site.value')) !!}
                                    {!! Form::text('other_data[${i}][input_value]','', ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group col-md-1">
                                    {!! Form::label('delete', __('site.delete')) !!}
                                    <a href="#" class="remove-input form-control btn btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>`;
            if (i<max) {
                $('.input-tag').append(input_view);
                console.log(input_view);
            }
            ++i;
        });
        $(document).on('click','.remove-input',function(){
            $(this).parent('div').parent('div').remove();
            --i;
        });

    </script>
@endpush
<div class="tab-pane fade" id="other-data" role="tabpanel" aria-labelledby="nav-contact-tab">
    <div class="input-tag ">
        @foreach ($product->other_data as $item)
            <div class="form-row">
                <div class="form-group col ">
                    {!! Form::label('input_key', __('site.key')) !!}
                    {!! Form::text('other_data['.$item->id.'][input_key]',$item->input_key, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group col">
                    {!! Form::label('input_value', __('site.value')) !!}
                    {!! Form::text('other_data['.$item->id.'][input_value]',$item->input_key, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-md-1">
                    {!! Form::label('delete', __('site.delete')) !!}
                    <a href="#" class="remove-input form-control btn btn-danger"><i class="fa fa-trash"></i></a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="form-group">
        <a href="#" class="add-input btn btn-info"><i class="fa fa-plus"></i></a>
    </div>
</div>