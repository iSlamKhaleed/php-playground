var ids = [];
var deleteId;
$(function () {
    $('#btnTakeAction').click(function () {
        if (ids.length < 1) {
            alert('Please choose comments first');
            return;
        }
        SubmitPostRequest([['action', $('#action').val()],
        ['ids', ids]]).submit();

    });

    $('.deleteBtn').on('click', function () {
        deleteId = $(this).attr('comment_id');
    });

    $('#btnConfirmDelete').click(function(){
        $.post('/requests/comments_helper.php',
            {'delete' : deleteId},
            function(){
                location = location;
            });
        // location = '?delete=' + deleteId;
    });

});

function approveDisapprove(post) {
    SubmitPostRequest([
        ['status_change_id', $(post).attr('tag')],
        ['status', post.value]
    ]).submit();
};

function toggleId(post) {
    if ($(post).is(':checked')) {
        ids.push($(post).attr('comment_id'));
    } else {
        ids = ids.filter(
            id => id != $(post).attr('comment_id'));
    }
}

function SubmitPostRequest(data) {
    var f = document.createElement('form');
    document.body.appendChild(f);
    f.method = 'POST'
    f.Action = '';
    data.forEach(d => {
        var el = document.createElement('input');
        el.type = 'hidden';
        el.name = d[0];
        el.value = d[1];
        f.appendChild(el);
    });
    return f;
}
