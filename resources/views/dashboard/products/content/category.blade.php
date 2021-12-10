@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            
            $('#jstree').jstree({
                "core" : {
                    'data' : {!! get_cat($product->category_id) !!},
                    "themes" : {
                            "variant" : "large",

                        }
                },
                "checkbox" : {
                    "keep_selected_style" : false
                },
                "plugins" : [ "wholerow" ]
            });

            $('#jstree').on('changed.jstree',function (e,data) {
                var j=data.selected;
                var r=[];
                for (let i =0; i < j.length; i++) {
                    r.push(data.instance.get_node(data.selected[i]).id);
                }
                var category_id =r.join(',');
                $('.category-id').val(category_id);

                //get weights and sizes
                $.ajax({
                    url:'{{Route('dashboard.shipping.info')}}',
                    dataType:'html',
                    type:'post',
                    data:{
                        _token:'{{ csrf_token() }}',
                        id:category_id,
                        product_id:'{{$product->id}}'
                    },
                    success:function(data){
                        console.log(data);
                        $('.other-info').attr('hidden',false);
                        $('.shipping_info').html(data);
                    }
                });
            });
        });


    </script>
@endpush

<div class="tab-pane fade" id="category" role="tabpanel" aria-labelledby="nav-profile-tab">
    <h2>@lang('site.category')</h2>
    <input type="hidden" name="category_id" class="category-id" value="{{old('category_id')}}">
    <div id="jstree"></div>
</div>