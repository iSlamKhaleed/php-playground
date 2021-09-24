$(function(){
    $('#btnCreatePost').click(function(){
        var valid = true;
        if ($('#postTitle').val() == ''){
            $('#errTitle').removeClass('hidden');
            valid = false;
        }
        if ($('#postContent').val() == ''){
            $('#errContent').removeClass('hidden');
            valid = false;
        }
        if (!valid)
            return;
        $('#frmCreatePost').submit();
    });

    $('#postTitle').blur(function () {
        if ($('#postTitle').val() == '') 
            $('#errTitle').removeClass('hidden');
        else
            $('#errTitle').addClass('hidden');
    });

    $('#postContent').blur(function () {
        if ($('#postContent').val() == '') 
            $('#errContent').removeClass('hidden');
        else
            $('#errContent').addClass('hidden');
    })

})