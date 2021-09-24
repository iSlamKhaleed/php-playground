var usernameAvailable = false;
var emailAvailable = false;
$(function () {

    $('#btnCreateUser').click(function () {
        var valid = true;
        if ($('#userName').val() == '' || !usernameAvailable) {
            $('#errUsrnm').removeClass('hidden');
            valid = false;
        }

        if ($('#password').val() == '') {
            $('#errPswrd').removeClass('hidden');
            valid = false;
        }
        if ($('#confPassword').val() != $('#password').val()) {
            $('#errCnfPswrd').removeClass('hidden');
            valid = false;
        }
        if ($('#firstName').val() == '') {
            $('#errFrstNm').removeClass('hidden');
            valid = false;
        }
        if ($('#lastName').val() == '') {
            $('#errLstNm').removeClass('hidden');
            valid = false;
        }
        if ($('#email').val() == '' || !emailAvailable) {
            $('#errEml').text('Please enter a valid email address')
            $('#errEml').removeClass('hidden');
            valid = false;
        }
        if (!valid)
            return;
        $('#frmCreateUser').submit();
    });

    $('#userName').blur(function () {
        if ($('#userName').val() == '') {
            $('#errUsrnm').removeClass('hidden');
            $('#errUsrnm').text('Please enter a valid username');
        } else {
            $('#errUsrnm').addClass('hidden');
            $('#usernamefeedback').html('<img src="/media/loading.gif" class="inline" width=50></img><p class="inline"> checking availability</p>');
            $.get('/requests/registration_helper.php?usernamecheck=' + $('#userName').val(),
                function (userExists) {
                    if (userExists) {
                        $('#usernamefeedback').html('<img src="/media/cross.png" class="inline" width=10></img><p class="inline error"> This user name is already registered.</p>');
                        usernameAvailable = false;
                    } else {
                        $('#usernamefeedback').html('<img src="/media/tick.png" class="inline" width=10></img><p class="inline"> username available</p>');
                        usernameAvailable = true;
                    }
                })
        }
    });

    $('#firstName').blur(function () {
        if ($('#firstName').val() == '')
            $('#errFrstNm').removeClass('hidden');
        else
            $('#errFrstNm').addClass('hidden');
    })

    $('#lastName').blur(function () {
        if ($('#lastName').val() == '')
            $('#errLstNm').removeClass('hidden');
        else
            $('#errLstNm').addClass('hidden');
    });

    $('#password').blur(function () {
        if ($('#password').val() == '')
            $('#errPswrd').removeClass('hidden');
        else
            $('#errPswrd').addClass('hidden');
    })

    $('#confPassword').blur(function () {
        if ($('#confPassword').val() != $('#password').val())
            $('#errCnfPswrd').removeClass('hidden');
        else
            $('#errCnfPswrd').addClass('hidden');
    });

    $('#email').blur(function () {
        if ($('#email').val() == '') {
            $('#errEml').removeClass('hidden');
            $('#errEml').text('Please enter a valid email address')
        } else {
            $('#errEml').addClass('hidden');
            $.get('/requests/registration_helper.php?emailcheck=' + $('#email').val(),
                function (emailExists) {
                    if (emailExists) {
                        emailAvailable = false;
                        $('#emailfeedback').html('<img src="/media/cross.png" class="inline" width=10></img><p class="inline"> This email is already registered</p>')
                    } else{
                        emailAvailable = true;
                        $('#emailfeedback').html('');
                    }
                })
        }
    })
})