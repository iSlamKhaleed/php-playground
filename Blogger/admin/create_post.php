<?php include_once 'includes/header.php' ?>
<?php include_once '../includes/db_guys/db_categories.php' ?>
<?php include_once '../includes/db_guys/db_posts.php' ?>
<?php include_once 'includes/nav.php' ?>

<?php
$edit = $postAdded = false;
$postTitle = $postContent = $postCategory = $postImage = $postTags = '';

if (isset($_GET['edit']) && isset($_POST['postTitle']))
    $postAdded = UpdateThePost();
if (isset($_GET['edit']))
    GetPostDetailsForEdit();
else if (isset($_POST['postTitle']))
    $postAdded = AddPost();

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
        <div class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <form action="" method="POST" enctype="multipart/form-data" id="frmCreatePost">
                        <div class="form-group form-row p-5">
                            <label for="postTitle" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="postTitle" id="postTitle" value="<?php echo $postTitle ?>">
                                <p class="error hidden" id="errTitle">Please enter a valid post title</p>
                            </div>
                        </div>
                        <div class="form-group form-row p-5">
                            <label for="categoryId" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="categoryId">
                                    <?php FillCategories() ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-row p-5">
                            <label for="postImage" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="postImage" value="<?php echo $postImage ?>">
                            </div>
                        </div>
                        <div class="form-group form-row p-5">
                            <label for="postContent" class="col-sm-2 col-form-label">Content</label>
                            <div class="col-sm-10">
                                <textarea name="postContent" id="postContent" class="form-control"><?php echo $postContent ?></textarea>
                                <p class="error hidden" id="errContent">Please add content</p>
                            </div>
                        </div>
                        <div class="form-group form-row p-5 mt-5">
                            <label for="postTags" class="col-sm-2 col-form-label">Tags</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="postTags" value="<?php echo $postTags ?>">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
            <div class="row text-center">
                <div class="col">
                    <Button id="btnCreatePost" class="btn btn-primary mt-5"><?php echo $edit ? 'Update' : 'Create' ?> post</Button>
                    <p id="lblResult" class="success <?php echo $postAdded ? '' : 'hidden' ?>">Post has been submitted successfully</p>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<script src="js/create_post.js"></script>

<?php
include_once 'includes/footer.php';

function FillCategories()
{
    global $postCategory, $edit;
    foreach (GetCategories() as $c) {
?>
        <option value="<?php echo $c['cat_id'] ?>" <?php echo $edit && $c['cat_title'] == $postCategory ? 'selected' : '' ?>><?php echo $c['cat_title'] ?></option>
<?php
    }
}


function AddPost()
{
    $imgPath = '/media/' . $_FILES['postImage']['name'];
    move_uploaded_file($_FILES['postImage']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $imgPath);
    InsertPost($_POST['postTitle'], $_POST['postContent'], $_POST['categoryId'], $_SESSION['user_id'], $imgPath, $_POST['postTags']);
    return true;
}

function UpdateThePost()
{
    global $postImage;
    $imgPath = $postImage;
    if (isset($_FILES['postImage']['tmp_name']) && $_FILES['postImage']['tmp_name'] != '') {
        $imgPath = '/media/' . $_FILES['postImage']['name'];
        move_uploaded_file($_FILES['postImage']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $imgPath);
    }
    UpdatePost($_GET['edit'], $_POST['postTitle'], $_POST['postContent'], $_POST['categoryId'], $imgPath, $_POST['postTags']);
    return true;
}

function GetPostDetailsForEdit()
{
    global $postCategory, $postContent, $postTags, $postTitle, $postImage, $edit;
    $post = GetPostDetails($_GET['edit']);
    $postCategory = $post['cat_title'];
    $postTags = $post['post_tags'];
    $postContent = $post['post_content'];
    $postImage = $post['post_image'];
    $postTitle = $post['post_title'];
    $edit = true;
}

?>