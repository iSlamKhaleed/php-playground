<?php include_once 'includes/header.php' ?>
<!-- Navigation -->
<?php include_once 'includes/nav.php' ?>
<?php include_once '../includes/db_guys/db_posts.php' ?>

<?php
if (isset($_GET['delete']))
    DeletePost($_GET['delete']);
else if (isset($_POST['status_change_id']))
    ApproveDisapprovePost();
else if (isset($_POST['action']))
    TakeAction();

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
                    <th scope="col">
                        <input type="checkbox" onchange="toggleSelection(this)">
                    </th>
                    <th scope="col">id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Date</th>
                    <th scope="col">Author</th>
                    <th scope="col">Image</th>
                    <th scope="col">Content</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Status</th>
                    <th scope="col">Views</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Actions</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                    <?php DisplayPosts() ?>
                </tbody>
            </table>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<script src="../js/posts.js"></script>
<?php include_once 'includes/footer.php';

function DisplayPosts()
{
    foreach (GetAllPosts() as $p) {
?>
        <tr>
            <th scope="row"><input type="checkbox" post_id = "<?php echo $p['post_id']?>" class="postBoxes"></th>
            <td><?php echo $p['post_id'] ?></td>
            <td><?php echo $p['post_title'] ?></td>
            <td><?php echo $p['cat_title'] ?></td>
            <td><?php echo $p['post_date'] ?></td>
            <td><?php echo $p['username'] ?></td>
            <td>
                <img width="150" class="img-responsive" src="<?php echo $p['post_image'] ?>">
                <?php echo $p['post_image'] ?>
            </td>
            <td><?php echo substr($p['post_content'], 0, 70) ?></td>
            <td><?php echo substr($p['post_tags'], 0, 70) ?></td>
            <td>
                <select class="form-control" onchange="approveDisapprove(this)">
                    <option <?php if ($p['post_status'] == 'draft') echo 'selected' ?> value="draft">Draft</option>
                    <option <?php if ($p['post_status'] == 'approved') echo 'selected' ?> value="approved">Approved</option>
                    <option <?php if ($p['post_status'] == 'rejected') echo 'selected' ?> value="rejected">Rejected</option>
                </select>
            </td>
            <td><?php echo $p['post_views_count'] ?></td>
            <td><?php echo $p['comments'] ?? 0 ?></td>
            <td><a href="../post.php?id=<?php echo $p['post_id'] ?>">View</a></td>
            <td><a href="create_post.php?edit=<?php echo $p['post_id'] ?>">Edit</a></td>
            <td><a class="error delete" style="cursor: pointer;" post_id="<?php echo $p['post_id']?>">Delete</a></td>
        </tr>
<?php
    }
}

function ApproveDisapprovePost()
{
    AlterPostStatus($_POST['status_change_id'], $_POST['status']);
}

function TakeAction()
{
    switch ($_POST['action']) {
        case 'delete':
            DeleteSomePosts(explode(',', $_POST['ids']));
            break;
        case 'approve':
            AlterSomePostsStatus(explode(',', $_POST['ids']),'approved');
            break;
        case 'disapprove':
            AlterSomePostsStatus(explode(',', $_POST['ids']), 'rejected');
            break;
        case 'draft':
            AlterSomePostsStatus(explode(',', $_POST['ids']), 'draft');
            break;
    }
}
?>
<script src="js/posts.js"></script>