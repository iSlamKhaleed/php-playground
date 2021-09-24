function togglePassword() {
    if ($('#password').attr('type') == 'password') {
        $('#password').attr('type', 'text');
        $('#btnShoPswrd').removeClass('btn-primary');
    } else {
        $('#password').attr('type', 'password');
        $('#btnShoPswrd').addClass('btn-primary');
    }
}

function login() {
    var valid = true;
    if ($('#username').val() == '') {
        valid = false;
        $('#errUsrNm').removeClass('hidden');
    }
    if ($('#password').val() == '') {
        valid = false;
        $('#errPswrd').removeClass('hidden')
    }
    if (!valid)
        return;
    $('#frmLgn').submit();
}

function usernameBlur() {
    if ($('#username').val() == '')
        $('#errUsrNm').removeClass('hidden');
    else
        $('#errUsrNm').addClass('hidden');

}
function passwordBlur() {
    if ($('#password').val() == '') 
        $('#errPswrd').removeClass('hidden')
    else
        $('#errPswrd').addClass('hidden')

}