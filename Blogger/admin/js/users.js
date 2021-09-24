function changeUserRole(user){

    var f = document.createElement('form');
    document.body.appendChild(f);
    f.action='';
    f.method='POST'

    var el1 = document.createElement('input');
    el1.type = 'hidden';
    el1.name = 'change_user_role';
    el1.value = $(user).attr('userid');
    f.appendChild(el1);
    var el2 = document.createElement('input');
    el2.type = 'hidden';
    el2.name = 'role';
    el2.value = user.value;
    f.appendChild(el2);

    f.submit();
}