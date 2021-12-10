// image preview
$(".image").change(function () {

    if (this.files && this.files[0]) {

        var reader = new FileReader();

        if ($(this).attr("name")=='logo' ) {
            reader.onload = function (e) {
                $('.logo-preview').attr('src', e.target.result);
            }
        }else if($(this).attr("name")=='icon'){
            reader.onload = function (e) {
                $('.icon-preview').attr('src', e.target.result);
            }
        }
        
        reader.readAsDataURL(this.files[0]);
    }
});

