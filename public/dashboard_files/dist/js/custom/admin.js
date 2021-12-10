$(function () {

    //submit delete
    $(document).on('click','.del-all',function () {
        $('#form-data').submit();
    });

    // show delete modal
    $(document).on('click','.del-btn',function () {
        var checked_items = $('input[class=check-item]:checkbox:checked').length;
        console.log(checked_items)
        if (checked_items>0) {
            $('.record-count').text(checked_items);
            $('.empty-records').attr('hidden',true);
            $('.not-empty-records').removeAttr('hidden');
        }else {
            $('.record-count').text('');
            $('.not-empty-records').attr('hidden',true);
            $('.empty-records').removeAttr('hidden');
        }
        $('#delall').modal('show');
    });
        
})

//check all boxes
function check_all() {
    console.log($('input[class=check-all]:checkbox:checked').length == 0);
    $('.check-item').each(function () {

        if ($('.check-all').is(":checked")) {
            $(this).prop('checked',true)
        }else{
            $(this).prop('checked',false)
        }
    });
}







