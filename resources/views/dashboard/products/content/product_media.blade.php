@push('css')
     <style>
          .dz-image img {
               width: 100%;
               height: 100%;
          }
          .dropzone.dz-started .dz-message {
               display: block !important;
          }
          .dropzone {
               border: 2px dashed #028AF4 !important;;
          }
          .dropzone .dz-preview.dz-complete .dz-success-mark {
          opacity: 1;
          }
          .dropzone .dz-preview.dz-error .dz-success-mark {
          opacity: 0;
          }
          .dropzone .dz-preview .dz-error-message{
               top: 144px;
          }
     </style>
@endpush
@push('js')
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
     
     <script type="text/javascript">
          Dropzone.autoDiscover = false;
          $(document).ready(function(){
               $('#dropzonefileupload').dropzone({
                    url:"{{ url('dashboard/upload/image/'.$product->id) }}",
                    paramName:'file',
                    uploadMultiple:false,
                    maxFilesize:2,
                    maxFiles:15,
                    dictDefaultMessage:"<h4>{{ __('site.drop_here') }}</h4>",
                    dictRemoveFile:'{{ __('site.delete') }}',
                    acceptedFiles:'image/*',
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    params:{
                         _token:"{{ csrf_token() }}",
                    },
                    addRemoveLinks:true,
                    removedfile:function(file){
                         $.ajax({
                              url:'{{ url('dashboard/delete/image') }}',
                              type:'post',
                              dataType:'json',
                              data:{
                                   _token:'{{ csrf_token() }}',
                                   id:file.fId,
                              },
                         });
                         var fmock;
                         return (fmock=file.previewElement )!= null ? fmock.parentNode.removeChild(file.previewElement): void 0;
                    },
                    init:function(){
                         @foreach ($product->files()->get() as $file )
                              var mock = {
                                   fId:'{{$file->id}}',
                                   name:'{{$file->name}}',
                                   size:'{{$file->size}}',
                                   type:'{{$file->mime_type}}'
                              };
                              this.emit('addedfile',mock);
                              this.options.thumbnail.call(this,mock,'{{asset('storage/'.$file->full_file)}}');
                              this.emit("complete", mock); 
                         @endforeach
                         this.on('sending',function(file,xhr,formData){
                              formData.append('fId','');
                              file.fId='';
                         });
                         this.on('success',function(file,response){
                              file.fId=response.id;
                         });
                    },
               });

               $('#mainphoto').dropzone({
                    url:"{{ url('dashboard/update/image/'.$product->id) }}",
                    paramName:'photo',
                    uploadMultiple:false,
                    maxFilesize:2,
                    maxFiles:1,
                    dictDefaultMessage:"<h4>{{ __('site.main_photo') }}</h4>",
                    dictRemoveFile:'{{ __('site.delete') }}',
                    acceptedFiles:'image/*',
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    params:{
                         _token:"{{ csrf_token() }}",
                    },
                    addRemoveLinks:true,
                    removedfile:function(file){
                         $.ajax({
                              url:'{{ url('dashboard/delete/product/image/'.$product->id) }}',
                              type:'post',
                              dataType:'json',
                              data:{
                                   _token:'{{ csrf_token() }}',
                                   id:file.fId,
                              },
                         });
                         var fmock;
                         return (fmock=file.previewElement )!= null ? fmock.parentNode.removeChild(file.previewElement): void 0;
                    },
                    init:function(){
                         var mock = {
                              name:'{{$product->title}}',
                              size:'',
                              type:''
                         };
                         @if (!empty($product->photo))
                              this.emit('addedfile',mock);
                              this.options.thumbnail.call(this,mock,'{{asset('storage/'.$product->photo)}}');
                              this.emit("complete", mock); 
                         @endif

                         this.on('sending',function(file,xhr,formData){
                              formData.append('fId','');
                              file.fId='';
                         });
                         this.on('success',function(file,response){
                              file.fId=response.id;
                         });
                    },
               });
          }); 

     </script>
@endpush  

<div class="tab-pane fade " id="product-media" role="tabpanel" aria-labelledby="nav-profile-tab">
     <h2>@lang('site.main_photo')</h2>
     <div class="dropzone dz-default dz dz-message" id="mainphoto"> </div>
     <br>
     <h2>@lang('site.media')</h2>
     <div class="dropzone dz-default dz dz-message" id="dropzonefileupload"> </div>
</div>