$(function () {

    $('#btnSendEmail').click(function () {

        var valid = true;
        if ($('#email').val() == '') {
            valid = false;
            $('#errEml').removeClass('hidden');
        }
        if ($('#subject').val() == '') {
            valid = false;
            $('#errSbjct').removeClass('hidden');
        }
        if ($('#body').val() == '') {
            valid = false;
            $('#errBdy').removeClass('hidden')
        }
        if (!valid)
            return;
        $('#frmSendEmail').submit();
    });

    $('#email').blur(function () {
        if ($('#email').val() == '')
            $('#errEml').removeClass('hidden');
        else
            $('#errEml').addClass('hidden');
    });

    $('#subject').blur(function () {
        if ($('#subject').val() == '')
            $('#errSbjct').removeClass('hidden');
        else
            $('#errSbjct').addClass('hidden');
    });

    $('#body').blur(function () {
        if ($('#body').val() == '')
            $('#errBdy').removeClass('hidden');
        else
            $('#errBdy').addClass('hidden');
    });
});
