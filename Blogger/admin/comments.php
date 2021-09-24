<?php include_once 'includes/header.php' ?>
<!-- Navigation -->
<?php include_once 'includes/nav.php' ?>
<?php include_once '../includes/db_guys/db_comments.php' ?>

<?php
if (isset($_POST['status_change_id']))
    ApproveDisapproveComment();
else if (isset($_POST['action']))
    TakeActionComment();
?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Blank Page
                    <small>Subheading</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Blank Page
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="form-inline">
                <select class="form-control" id="action">
                    <option value="approve">Approve selected</option>
                    <option value="draft">Draft selected</option>
                    <option value="disapprove">Reject selected</option>
                    <option value="delete">Delete selected</option>
                </select>
                <button class="btn btn-primary" id="btnTakeAction">Apply</button>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped table-hover">
                <thead>
                    <th scope="col"></th>
                    <th scope="col">id</th>
                    <th scope="col">Post ID</th>
                    <th scope="col">Post Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Author email</th>
                    <th scope="col">Date</th>
                    <th scope="col">Content</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </thead>
                <tbody>
                    <?php DisplayComments() ?>
                </tbody>
            </table>
        </div>

    </div>
    <!-- /.container-fluid -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>Are you sure you want to delete this comment?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="btnConfirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->
<?php include_once 'includes/footer.php';

function DisplayComments()
{
    foreach (GetAllComments() as $p) {
?>
        <tr>
            <th scope="row"><input type="checkbox" onchange="toggleId(this)" comment_id="<?php echo $p['comment_id'] ?>"></th>
            <td><?php echo $p['comment_id'] ?></td>
            <td><a href="../post.php?id=<?php echo $p['comment_post_id'] ?>"><?php echo $p['comment_post_id'] ?></a></td>
            <td><a href="../post.php?id=<?php echo $p['comment_post_id'] ?>"><?php echo $p['post_title'] ?></a></td>
            <td><?php echo $p['comment_author'] ?></td>
            <td><?php echo $p['comment_author_email'] ?></td>
            <td><?php echo $p['comment_date'] ?></td>
            <td><?php echo substr($p['comment_content'], 0, 70) ?></td>
            <td>
                <select class="form-control" tag="<?php echo $p['comment_id'] ?>" onchange="approveDisapprove(this)">
                    <option <?php if ($p['comment_status'] == 'draft') echo 'selected' ?> value="draft">Draft</option>
                    <option <?php if ($p['comment_status'] == 'approved') echo 'selected' ?> value="approved">Approved</option>
                    <option <?php if ($p['comment_status'] == 'rejected') echo 'selected' ?> value="rejected">Rejected</option>
                </select>
            </td>
            <td><a class="error deleteBtn" style="cursor: pointer;" comment_id="<?php echo $p['comment_id'] ?>"
                data-toggle="modal" data-target="#deleteModal" >Delete</a></td>
        </tr>

<?php
    }
}

function ApproveDisapproveComment()
{
    AlterCommentStatus($_POST['status_change_id'], $_POST['status']);
}

function TakeActionComment()
{
    switch ($_POST['action']) {
        case 'delete':
            DeleteSomeComments(explode(',', $_POST['ids']));
            break;
        case 'approve':
            AlterSomeCommentsStatus(explode(',', $_POST['ids']), 'approved');
            break;
        case 'disapprove':
            AlterSomeCommentsStatus(explode(',', $_POST['ids']), 'rejected');
            break;
        case 'draft':
            AlterSomeCommentsStatus(explode(',', $_POST['ids']), 'draft');
            break;
    }
}

?>
<script src="js/comments.js"></script>