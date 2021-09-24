$(function(){
    $('#btnCmnt').click(function(){
        if ($('#content').val() == '')
            $('#errCntnt').removeClass('hidden');
        else
            $('#frmCmnt').submit();
    });
})