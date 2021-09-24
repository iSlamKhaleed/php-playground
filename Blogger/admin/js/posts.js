$(function () {

    $('#btnTakeAction').click(function () {
        var ids = [];
        $('.postBoxes').each(function () {
            if (this.checked)
                ids.push($(this).attr('post_id'));
        });
        if (ids.length < 1) {
            alert('Please choose posts first');
            return;
        }
        SubmitPostRequest([
            ['action', $('#action').val()],
            ['ids', ids]]);

    });

    $(document).on('click', '.delete', function () {
        if (confirm('Are you sure?'))
            location = 'posts.php?delete=' + $(this).attr('post_id')
    });

});

function approveDisapprove(post) {
    SubmitPostRequest([
        ['status_change_id', $(post).parent().siblings().eq(1).text()],
        ['status', post.value]]);
};

// function addId(post) {
//     if ($(post).is(':checked'))
//         ids.push($(post).parent().next().text());
//     else
//         ids = ids.filter(
//             id => id != $(post).parent().next().text());
// }

function SubmitPostRequest(data) {
    var f = document.createElement('form');
    f.action = '';
    f.method = 'POST';
    document.body.appendChild(f);
    data.forEach(d => {
        var el = document.createElement('input');
        el.type = 'hidden';
        el.name = d[0];
        el.value = d[1];
        f.appendChild(el);
    });
    f.submit();
}

function toggleSelection(parent) {
    $('.postBoxes').each(function () {
        this.checked = parent.checked;
    })
}
